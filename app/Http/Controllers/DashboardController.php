<?php

namespace App\Http\Controllers;

use App\Category;
use App\Milestone;
use App\Project;
use App\Report;
use App\Subscriber;
use App\Trx;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function __construct()
    {
        $basic = GeneralSettings::first();
    }

    public function categories()
    {
        $categories = Category::latest()->paginate(15);
        $page_title = "Job Category ";
        return view('admin.category.index', compact('categories', 'page_title'));
    }

    public function categoryStore(Request $request)
    {
        Category::create($request->all());
        session()->flash('success', 'Saved successfully');
        return back();
    }

    public function categoryUpdate(Request $request, $id)
    {
        $data = Category::findorFail($id);
        $data->fill($request->all())->save();
        session()->flash('success', 'Update successfully');
        return back();
    }

    public function projects()
    {
        $data['page_title'] = "Manage Project";
        $data['projects'] = Project::where('approve', 0)->latest()->paginate(20);
        return view('admin.pages.projects', $data);
    }


    public function projectApprove(Request $request, $id)
    {
        $data = Project::findorFail($id);
        $data->approve = 1;
        $data->save();
        session()->flash('success', 'Project Approved!!');

        $msg = $data->title . ' Approved By admin ';
        send_email($data->user->email, $data->user->username, 'Approve Job Post', $msg);
        return back();
    }

    public function projectReject(Request $request, $id)
    {
        $data = Project::findorFail($id);
        $data->approve = -1;
        $data->save();
        session()->flash('success', 'Project Rejected!!');

        $msg = $data->title . ' Rejected By admin ';
        send_email($data->user->email, $data->user->username, 'Rejected Job Post', $msg);
        return back();
    }

    public function projectSearch(Request $request)
    {
        $this->validate($request, ['search' => 'required',]);
        $search = $request->input('search', null);
        $query = Project::select('id', 'title', 'keywords', 'experience', 'deadline', 'category_id', 'user_id', 'image', 'description', 'deleted_at', 'created_at', 'updated_at');

        $query = is_null($search) ? $query : $query->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('keywords', 'LIKE', '%' . $search . '%')
            ->orWhere('experience', 'LIKE', '%' . $search . '%')
            ->orWhere('salary', 'LIKE', '%' . $search . '%')
            ->orWhere('deadline', 'LIKE', '%' . $search . '%')
            ->orWhereHas('category', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('username', 'LIKE', '%' . $search . '%');
                $q->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        $data['projects'] = $query->latest()->get();
        $data['page_title'] = "Search Project";
        return view('admin.pages.search-projects', $data);
    }

    public function approvedAllProjects()
    {
        $data['page_title'] = "Approved Projects";
        $data['projects'] = Project::where('approve', 1)->latest()->paginate(20);
        return view('admin.pages.projects-approved', $data);
    }


    public function allApproveProjectSearch(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
        ]);
        $search = $request->input('search', null);
        $query = Project::select('id', 'title', 'keywords', 'experience', 'deadline', 'category_id', 'user_id', 'image', 'description', 'deleted_at', 'created_at', 'updated_at', 'approve');

        $query = is_null($search) ? $query : $query->where('approve', '=', 1)
            ->where(function ($query) use ($search) {
                $query->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('keywords', 'like', '%' . $search . '%')
                    ->orWhere('experience', 'like', '%' . $search . '%')
                    ->orWhere('salary', 'LIKE', '%' . $search . '%')
                    ->orWhere('deadline', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('username', 'LIKE', '%' . $search . '%');
                        $q->orWhere('email', 'LIKE', '%' . $search . '%');
                    });
            });
        $data['projects'] = $query->latest()->get();
        $data['page_title'] = "Search Approved Project";
        return view('admin.pages.search-projects-approved', $data);
    }


    public function reports()
    {
        $data['page_title'] = "All Milestone  Reports ";
         $data['reports'] = Report::where('status', 0)->where('report_from', '!=',0)->where('report_against', '!=',0)->latest()->paginate(20);
        return view('admin.pages.reports', $data);
    }

    public function reportsAllView($id)
    {
        $data['page_title'] = "Milestone Reports Preview";
        $data['reports'] = Report::where('milestone_id',$id)->get();
        $data['milestone_id'] = $id;
        foreach ($data['reports'] as $code)
        {
            $code->is_read = 1;
            $code->save();
        }
        return view('admin.pages.reports-list', $data);
    }

    public function milestoneAccepted(Request $request)
    {
        $request->validate([
            'milestone_id' => 'required',
            'user_id' => 'required',
        ]);
        $basic =  GeneralSettings::first();

         $data =  Milestone::find($request->milestone_id);
        if($data->user_id == $request->user_id)
        {
            $user =  User::find($data->user_id) ;
            $user->balance += $data->amount;
            $user->save();

            $data->status = 1;
            $data->save();

            Trx::create([
                'user_id' => $user->id,
                'amount' => $data->amount,
                'main_amo' => $user->balance,
                'charge' => 0,
                'type' => '+',
                'title' => 'Added Balance By Admin From ' . $data->project->title . ' Project milestone',
                'trx' => str_random(16)
            ]);

            $txt = 'Added '. $data->amount . ' '.  $basic->currency . ' By Admin From ' . $data->project->title . ' Project milestone';
            send_email($user->email, $user->username, 'Added money ', $txt);

        }elseif($data->author_id == $request->user_id)
        {
            $user =  User::find($data->author_id) ;
            $user->balance += $data->amount;
            $user->save();

            $data->status = -1;
            $data->save();

            Trx::create([
                'user_id' => $user->id,
                'amount' => $data->amount,
                'main_amo' => $user->balance,
                'charge' => 0,
                'type' => '+',
                'title' => 'Added Balance By Admin From ' . $data->project->title . ' Project milestone ',
                'trx' => str_random(16)
            ]);

            $txt = 'Added '. $data->amount . ' '.  $basic->currency . ' By Admin From ' . $data->project->title . ' Project milestone';
            send_email($user->email, $user->username, 'Added money ', $txt);
        }

        Report::where('milestone_id',$request->milestone_id)->update(['status' => 1]);

        return  redirect()->route('admin.reports');
    }

    public function storeReport(Request $request)
    {
        $request->validate([
            'milestone_id' => 'required',
            'report' => 'required',
        ]);
        $in = input::except('_token');
        Report::create($in);
        return back();
    }

    public function manageSubscribers()
    {
        $data['page_title'] = 'Subscribers';
        $data['events'] = Subscriber::latest()->paginate(30);
        return view('admin.pages.subscriber', $data);
    }


    public function updateSubscriber(Request $request)
    {
        $mac = Subscriber::findOrFail($request->id);
        $mac['status'] = $request->status;
        $res = $mac->save();

        if ($res) {
            return back()->with('success', ' Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Category');
        }
    }

    public function sendMail()
    {
        $data['page_title'] = 'Mail to Subscribers';
        return view('admin.pages.subscriber-email', $data);
    }

    public function sendMailsubscriber(Request $request)
    {
        $this->validate($request,
            [
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);
        $subscriber = Subscriber::whereStatus(1)->get();
        foreach ($subscriber as $data) {
            $to =  $data->email;
            $name = substr($data->email, 0, strpos($data->email, "@"));
            $subject = $request->subject;
            $message = $request->emailMessage;
            send_email($to, $name, $subject, $message);
        }
        $notification = array('message' => 'Mail Sent Successfully!', 'alert-type' => 'success');
        return back()->with($notification);
    }

}
