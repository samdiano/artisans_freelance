<?php

namespace App\Http\Controllers;

use App\AssignJob;
use App\BitJob;
use App\Category;
use App\Match;
use App\Milestone;
use App\Project;
use App\Report;
use App\Trx;
use App\UserResume;
use App\WithdrawLog;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use \Validator;
use Session;
use Image;
use App\Gateway;
use App\GeneralSettings;
use App\Deposit;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 2) {

            $data['users'] = User::where('type', '!=', 2)->where('status', 1)->inRandomOrder()->get();
            $data['page_title'] = "looking For An Expert Freelancer";
            return view('user.freelancer-list', $data);
        } else {
            $data['page_title'] = "Recent Jobs";
            $data['projects'] = Project::where('approve', 1)->where('deadline', '>=', Carbon::today())->latest()->get();
            return view('user.recent-job', $data);
        }
    }

    public function biography($id)
    {
        $user = User::whereId($id)->first();
        $data['page_title'] = "Biography";
        $data['user'] = $user;

        if ($user->type == 2) {
            return view('user.biography', $data);
        } elseif ($user->type == 1) {
            return view('user.freelancer-biography', $data);
        }
        abort(404);
    }


    public function mailAuthor(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'name' => 'required',
            'subject' => 'required',
            'receiver' => 'required|email',
            'sender' => 'required|email'
        ],
            [
                'sender.required' => "Email field is required.",
            ]);
        send_mail_author($request->sender, $request->receiver, $request->name, $request->subject, $request->message);

        session()->flash('success', 'Mail Send successfully');
        return back();
    }

    public function bitJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'offer' => 'required|numeric|min:0',
            'project_id' => 'required',
            'author_id' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $checkBit = BitJob::where('project_id', $request->project_id)->where('user_id', Auth::user()->id)->count();
        if ($checkBit > 0) {
            return "no_success";
        } else {
            $data['project_id'] = $request->project_id;
            $data['author_id'] = $request->author_id;
            $data['user_id'] = Auth::user()->id;
            $data['offer'] = $request->offer;
            $data['message'] = $request->message;
            $data['code'] = str_random(20);
            BitJob::create($data);
            return "success";
        }
    }


    public function bitJobHomePage(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'offer' => 'required|numeric|min:0',
            'project_id' => 'required',
            'author_id' => 'required'
        ]);


        $checkBit = BitJob::where('project_id', $request->project_id)->where('user_id', Auth::user()->id)->count();
        if ($checkBit > 0) {
            return back()->with('alert', 'You are already Bid the job');

        } else {
            $data['project_id'] = $request->project_id;
            $data['author_id'] = $request->author_id;
            $data['user_id'] = Auth::user()->id;
            $data['offer'] = $request->offer;
            $data['message'] = $request->message;
            $data['code'] = str_random(20);
            BitJob::create($data);

            return back()->with('success', 'Bid Successfully.');
        }
    }


    public function detailsJob($id)
    {
        $data['project'] = $pro = Project::find($id);
        $data['page_title'] = "$pro->title";
        return view('user.job-details', $data);
    }


    public function bidProjectUserlist($id)
    {
        $data['page_title'] = "Bid Project List";
        $data['bitJobs'] = BitJob::where('project_id', $id)->where('author_id', Auth::user()->id)->orderBy('offer', 'desc')->paginate(15);
        return view('user.bid-project-userlist', $data);
    }

    public function assignJob(Request $request)
    {
        $auth = Auth::user();

        $checkAssign = AssignJob::where('user_id', $request->user_id)->where('project_id', $request->project_id)->count();
        if ($checkAssign > 0) {
            return back()->with('alert', 'Already assign job this user !!');
        } else {
            $in = Input::except('_token');
            $in['deadline'] = Carbon::parse($request->deadline);
            $in['author_id'] = $auth->id;
            AssignJob::create($in);
            return back()->with('success', 'This job assign for the user!');
        }
    }

    public function assignList()
    {
        $user = Auth::user();
        if ($user->type == 2) {
            $data['projects'] = AssignJob::where('author_id', $user->id)->latest()->paginate(15);
            $data['page_title'] = "Awarded  Job List";
            return view('user.assign-list', $data);
        }
        abort(404);
    }

    public function viewMileStone($id)
    {
        $user = Auth::user();
       $assignJob = AssignJob::where('id', $id)->where('author_id', $user->id)->first();
        if (isset($assignJob)) {
            $data['project'] = AssignJob::with('mileStones')->where('id', $id)->where('author_id', $user->id)->first();
             $data['mileStones_status'] = Milestone::where('assign_job_id',$id)->whereStatus(0)->count();
            $data['page_title'] = "Create Milestone";
            return view('user.milestone', $data);
        }
        abort(404);
    }

    public function createMileStone(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'user_id' => 'required',
            'project_id' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        if($user->balance > $request->amount){
            $data['assign_job_id'] =  $request->id;
            $data['amount'] =  $request->amount;
            $data['description'] =  $request->description;
            $data['author_id'] =  $user->id;
            $data['user_id'] =  $request->user_id;
            $data['project_id'] =  $request->project_id;
            Milestone::create($data);

            $user->balance -= $request->amount;
            $user->save();
            return back()->with('success', 'Milestone create Successfully');
        }
        return back()->with('alert', 'Insufficient Balance !');
    }

    public function reportLog($id)
    {
        $user = Auth::user();
        $milestone = Milestone::whereId($id)->where('user_id',$user->id)->first();
            if($milestone)
            {
                $data['milestone'] =  $milestone;
                $data['reports'] =Report::where('milestone_id',$id)->orderBy('id','asc')->get();
                $readType1 = Report::where('milestone_id',$id)->where('read_type1',0)->get();
                foreach ($readType1 as $read)
                {
                    $read->read_type1 = 1;
                    $read->save();
                }
                $data['page_title'] = "Group Conversation";
                return view('user.report-log', $data);
            }
            abort(404);
    }

    public function reportLogAuthor($id)
    {
        $user = Auth::user();
         $milestone = Milestone::whereId($id)->where('author_id',$user->id)->first();
        if($milestone)
        {
            $data['milestone'] =  $milestone;
            $data['reports'] =Report::where('milestone_id',$id)->orderBy('id','asc')->get();
            $readType2 = Report::where('milestone_id',$id)->where('read_type2',0)->get();
            foreach ($readType2 as $read)
            {
                $read->read_type2 = 1;
                $read->save();
            }
            $data['page_title'] = "Group Conversation";
            return view('user.report-log-author', $data);
        }
        abort(404);
    }

    public function sendReports(Request $request)
    {
        $request->validate([
            'report' => 'required',
            'report_against' => 'required',
            'milestone_id' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);
        $in = input::except('_token');
        $in['report_from'] = Auth::id();
        Report::create($in);
        return back();
    }
    public function removeAssignList(Request $request)
    {
        $data = AssignJob::find($request->id);
        $data->status = -1;
        $data->deleted_at = Carbon::now();
        $data->save();

        $txt = 'Your project removed  by ' . $data->author->name;
        send_email($data->user->email, $data->user->username, 'Cancel Project ', $txt);
        return back()->with('success', 'Remove Successfully');
    }

    public function activeJobList()
    {
        $user = Auth::user();
        if ($user->type == 1) {
            $data['projects'] = AssignJob::where('user_id', $user->id)->whereStatus(0)->latest()->paginate(15);
            foreach ( $data['projects'] as $l)
            {
                $l->notify = 1;
                $l->save();
            }
            $data['page_title'] = "My Jobs";
            return view('user.active-job', $data);
        }
        abort(404);
    }

    public function projectMileStoneList($id)
    {
        $user = Auth::user();
         $assignJob = AssignJob::where('id', $id)->where('user_id', $user->id)->first();
        if (isset($assignJob)) {
             $data['project'] = AssignJob::with('mileStones')->where('id', $id)->where('user_id', $user->id)->first();
            $data['page_title'] = " Milestone History";
            $data['status'] = Milestone::where('assign_job_id', $id)->where('status', 0)->count('id');
            foreach ($data['project']->mileStones as $upd)
            {
                $upd->is_read = 1;
                $upd->save();
            }

            return view('user.single-project-milestone', $data);
        }
        abort(404);
    }


    public function passedJobList()
    {
        $user = Auth::user();
        if ($user->type == 1) {
            $data['projects'] = AssignJob::where('user_id', $user->id)->whereStatus(1)->latest()->paginate(10);
            $data['page_title'] = "Passed Job";
            return view('user.passed-job', $data);
        }
        abort(404);
    }

    public function releaseAmount(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $basic =  GeneralSettings::first();

          $data =  Milestone::find($request->id);

         $user = User::find($data->user_id);
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
            'title' => 'Project Name:  ' . $data->project->title ,
            'trx' => str_random(16)
        ]);

        Trx::create([
            'user_id' => $data->author_id,
            'amount' => $data->amount,
            'main_amo' => $data->author->balance,
            'charge' => 0,
            'type' => '-',
            'title' => 'Project Name:  ' . $data->project->title,
            'trx' => str_random(16)
        ]);

        $txt = 'Added money '. $data->amount. ' '. $basic->currency . ' project from  ' .$data->project->title or '';
        send_email($user->email, $user->username, 'Added money ', $txt);
        return back()->with('success', 'Payment release Successfully');
    }

    public function rejectAmount(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $basic =  GeneralSettings::first();

        $data =  Milestone::find($request->id);

        $user = User::find($data->author_id);
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
            'title' => 'Project Name:  ' . $data->project->title ,
            'trx' => str_random(16)
        ]);

        $txt = 'Added money '. $data->amount. ' '. $basic->currency . "<br>". ' project : ' .$data->project->title .' from '.$data->user->name;
        send_email($user->email, $user->username, 'Added money ', $txt);
        return back()->with('success', 'Payment rejected Successfully');
    }


    public function userReport(Request $request)
    {
         $request->validate([
            'milestone_id' => 'required',
            'report' => 'required',
        ]);

         $milestone = Milestone::find($request->milestone_id);
        $user = Auth::user();
        $data['report_from'] = $user->id;
        if($user->id == $milestone->user_id) {
         $data['report_against'] = $milestone->author_id;
        }
        elseif($user->id == $milestone->author_id)
        {
            $data['report_against'] = $milestone->user_id;
        }

         $data['milestone_id'] = $milestone->id;
         $data['amount'] = $milestone->amount;
         $data['report'] = $request->report;
         Report::create($data);
        return back()->with('success', 'Report to Admin  Successfully');
    }


    public function cancelClientJob(Request $request)
    {
        $basic = GeneralSettings::first();
        $data = AssignJob::find($request->id);
        $data->status = -1;
        $data->deleted_at = Carbon::now();

        $user = User::find($data->author_id);
        $user->balance += $data->amount;
        $user->save();

        $data->save();

        $txt = 'Your proposal rejected   by ' . $data->user->name . ' Your Account Balance added ' . $data->amount . ' ' . $basic->currency;
        send_email($data->author->email, $data->author->username, 'Cancel Project ', $txt);
        return back()->with('success', 'Remove Successfully');
    }


    public function authCheck()
    {
        if (Auth()->user()->status == '1' && Auth()->user()->email_verify == '1' && Auth()->user()->sms_verify == '1') {
            return redirect()->route('home');
        } else {
            $data['page_title'] = "Authorization";
            return view('user.authorization', $data);
        }
    }

    public function sendVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->phone_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->phone_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('alert', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->phone_time = Carbon::now();
            $user->sms_code = $code;
            $user->save();
            send_sms($user->phone, 'Your Verification Code is ' . $code);

            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function smsVerify(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user->sms_code == $request->sms_code) {
            $user->phone_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('alert', 'Verification Code Did not matched');
        }
        return back();
    }

    public function sendEmailVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->email_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->email_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('alert', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->email_time = Carbon::now();
            $user->verification_code = $code;
            $user->save();
            send_email($user->email, $user->username, 'Verificatin Code', 'Your Verification Code is ' . $code);
            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function postEmailVerify(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($user->verification_code == $request->email_code) {
            $user->email_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('alert', 'Verification Code Did not matched');
        }
        return back();
    }


    public function editProfile()
    {
        $data['category'] = Category::whereStatus(1)->get();

        if (Auth::user()->type == 1) {
            $data['page_title'] = "Dashboard";
            $data['user'] = User::findOrFail(Auth::user()->id);
            return view('user.edit-profile', $data);
        } elseif (Auth::user()->type == 2) {
            $data['page_title'] = " Dashboard";
            $data['user'] = User::findOrFail(Auth::user()->id);
            return view('user.edit-employer-profile', $data);
        }
        abort(404);
    }

    public function submitProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'country' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|min:10|unique:users,phone,' . $user->id,
            'image' => 'mimes:png,jpg,jpeg',
            'cover' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method', '_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $user->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $filename;

            $path = './assets/images/user/';
            $link = $path . $user->image;
            if (file_exists($link)) {
                @unlink($link);
            }

            Image::make($image)->resize(400, 400)->save($location);
        }
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $filename = time() . '_' . $user->username . '_cover' . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['cover'] = $filename;

            $path = './assets/images/user/';
            $link = $path . $user->cover;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }

        $user->fill($in)->save();
        $notification = array('message' => 'Profile Updated Successfully.', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function editResume()
    {
        if (Auth::user()->type == 1) {
            $user = UserResume::whereUserId(Auth::user()->id)->first();
            $page_title = "My Resume";
            if ($user) {
                return view('user.update-resume', compact('page_title', 'user'));
            } else {
                return view('user.resume', compact('page_title'));
            }
        } else {
            abort(404);
        }
    }

    public function updateResume(Request $request)
    {
        $user = UserResume::whereUser_id($request->user_id)->first();
        $in = Input::except('_method', '_token');
        if ($user) {
            UserResume::where('user_id', $request->user_id)->update($in);
        } else {
            $in['user_id'] = $request->user_id;
            UserResume::create($in);
        }
        $notification = array('message' => 'Resume Updated Successfully.', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function addJob()
    {
        if (Auth::user()->type == 2) {
            $page_title = "Submit a Job";
            $category = Category::whereStatus(1)->get();
            $user = Auth::user();
            return view('user.add-job', compact('page_title', 'category', 'user'));
        }
        abort(404);
    }

    public function storeJob(Request $request)
    {
        $basic = GeneralSettings::first();
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'salary' => 'required',
            'keywords' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ],
            [
                'category_id.required' => "Job Category must be selected",
                'description.required' => "Project Description must be fill up",
            ]);
        $in = Input::except('_method', '_token');
        $in['user_id'] = Auth::user()->id;
        $in['deadline'] = Carbon::parse($request->deadline);

        if($basic->post_approve == 1)
        {
            $in['approve'] = 1;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . '.jpg';
            $location = 'assets/images/project/' . $filename;
            $in['image'] = $filename;
            Image::make($image)->save($location);
        }
        Project::create($in);
        $notification = array('message' => ' Saved Successfully.', 'alert-type' => 'success');
        return back()->with($notification);

    }

    public function manageJob()
    {
        if (Auth::user()->type == 2) {
            $user = Auth::user();
            $data['projects'] = Project::latest()->where('user_id', $user->id)->paginate(20);
            $data['page_title'] = "Manage Jobs";
            return view('user.manage-job', $data);
        }
        abort(404);
    }

    public function editJob($id)
    {
        if (Auth::user()->type == 2) {
            $data['page_title'] = "Edit Job";
            $data['category'] = Category::whereStatus(1)->get();
            $user = Auth::user();
            $data['project'] = Project::whereId($id)->where('user_id', $user->id)->first();
            if (isset($data['project'])) {
                return view('user.edit-job', $data);
            }
        }
        abort(404);
    }

    public function updateJob(Request $request)
    {
        $data = Project::findOrFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'salary' => 'required',
            'keywords' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ],
            [
                'category_id.required' => "Job Category must be selected",
                'description.required' => "Project Description must be fill up",
            ]);
        $in = Input::except('_method', '_token', 'id');
        $in['deadline'] = Carbon::parse($request->deadline);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . '.jpg';
            $location = 'assets/images/project/' . $filename;
            $in['image'] = $filename;

            $path = './assets/images/project/';
            $link = $path . $data->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }
        $data->fill($in)->save();

        $notification = array('message' => 'Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function deleteJob(Request $request)
    {
        $data = Project::find($request->id);
        $path = './assets/images/project/';
        $link = $path . $data->image;
        if (file_exists($link)) {
            @unlink($link);
        }
        $data->delete();

        $Deleted_data = Project::find($request->id);
        if ($Deleted_data) {
            $status = 1;
        } else {
            $status = 0;
        }
        return $status;
    }


    public function changePassword()
    {
        $data['page_title'] = "Change Password";
        return view('user.change-password', $data);
    }

    public function submitPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {

            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if (Hash::check($request->current_password, $c_password)) {

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                $notification = array('message' => 'Password Changes Successfully.', 'alert-type' => 'success');
                return back()->with($notification);
            } else {
                $notification = array('message' => 'Current Password Not Match', 'alert-type' => 'warning');
                return back()->with($notification);
            }

        } catch (\PDOException $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'warning');
            return back()->with($notification);
        }
    }

    public function deposit()
    {
        $user = Auth::user();
        if ($user->type == 2) {
            $data['page_title'] = "Select Payment Gateways";
            $data['gates'] = Gateway::whereStatus(1)->get();
            return view('user.deposit', $data);
        }
        abort(404);
    }

    public function depositDataInsert(Request $request)
    {
        $this->validate($request, ['amount' => 'required|numeric|min:1', 'gateway' => 'required']);

        if ($request->amount <= 0) {
            return back()->with('alert', 'Invalid Amount');
        } else {
            $gate = Gateway::findOrFail($request->gateway);

            if (isset($gate)) {
                if ($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount) {
                    $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
                    $usdamo = ($request->amount + $charge) / $gate->rate;

                    $depo['user_id'] = Auth::id();
                    $depo['gateway_id'] = $gate->id;
                    $depo['amount'] = $request->amount;
                    $depo['charge'] = $charge;
                    $depo['usd_amo'] = round($usdamo, 2);
                    $depo['btc_amo'] = 0;
                    $depo['btc_wallet'] = "";
                    $depo['trx'] = str_random(16);
                    $depo['try'] = 0;
                    $depo['status'] = 0;
                    Deposit::create($depo);

                    Session::put('Track', $depo['trx']);

                    return redirect()->route('user.deposit.preview');

                } else {
                    return back()->with('alert', 'Please Follow Deposit Limit');
                }
            } else {
                return back()->with('alert', 'Please Select Deposit gateway');
            }
        }

    }


    public function depositPreview()
    {
        $track = Session::get('Track');
        $data = Deposit::where('status', 0)->where('trx', $track)->first();
        $page_title = "Deposit Preview";
        return view('user.payment.preview', compact('data', 'page_title'));
    }

    public function activity()
    {
        $user = Auth::user();
        $data['invests'] = Trx::whereUser_id($user->id)->latest()->paginate(15);
        $data['page_title'] = "Transaction Log";
        return view('user.trx', $data);
    }

    public function depositLog()
    {
        $user = Auth::user();
        if ($user->type == 2) {
            $data['invests'] = Deposit::whereUser_id($user->id)->latest()->paginate(20);
            $data['page_title'] = "Deposit Log";
            return view('user.trans', $data);
        }
        abort(404);
    }

    public function withdrawLog()
    {
        $user = Auth::user();
        if ($user->type == 1) {
            $data['invests'] = WithdrawLog::whereUser_id($user->id)->where('status', '!=', 0)->latest()->paginate(20);
            $data['page_title'] = "Withdraw Log";
            return view('user.withdraw-log', $data);
        }
        abort(404);
    }

    public function withdrawMoney()
    {
        $user = Auth::user();

        if ($user->type == 1) {
            $data['withdrawMethod'] = WithdrawMethod::whereStatus(1)->get();
            $data['page_title'] = "Withdraw Money";
            return view('user.withdraw-money', $data);
        }
        abort(404);
    }

    public function requestPreview(Request $request)
    {
        $this->validate($request, [
            'method_id' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $basic = GeneralSettings::first();
        $bal = User::findOrFail(Auth::user()->id);

        $method = WithdrawMethod::findOrFail($request->method_id);
        $ch = $method->fix + round(($request->amount * $method->percent) / 100, $basic->decimal);
        $reAmo = $request->amount + $ch;
        if ($reAmo < $method->withdraw_min) {
            return back()->with('alert', 'Your Request Amount is Smaller Then Withdraw Minimum Amount.');
        }
        if ($reAmo > $method->withdraw_max) {
            return back()->with('alert', 'Your Request Amount is Larger Then Withdraw Maximum Amount.');
        }
        if ($reAmo > $bal->balance) {
            return back()->with('alert', 'Your Request Amount is Larger Then Your Current Balance.');
        } else {

            $tr = strtoupper(str_random(20));
            $w['amount'] = $request->amount;
            $w['method_id'] = $request->method_id;
            $w['charge'] = $ch;
            $w['transaction_id'] = $tr;
            $w['net_amount'] = $reAmo;
            $w['user_id'] = Auth::user()->id;
            $trr = WithdrawLog::create($w);
            $data['withdraw'] = $trr;
            Session::put('wtrx', $trr->transaction_id);

            $data['method'] = $method;
            $data['balance'] = Auth::user();

            $data['page_title'] = "Preview";
            return view('user.withdraw-preview', $data);
        }
    }


    public function requestSubmit(Request $request)
    {
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'withdraw_id' => 'required|numeric',
            'send_details' => 'required'
        ]);

        $ww = WithdrawLog::findOrFail($request->withdraw_id);
        $ww->send_details = $request->send_details;
        $ww->message = $request->message;
        $ww->status = 1;
        $ww->save();

        $user = Auth::user();
        $user->balance = $user->balance - $ww->net_amount;
        $user->save();

        $trx = Trx::create([
            'user_id' => $user->id,
            'amount' => $ww->amount,
            'main_amo' => $user->balance,
            'charge' => $ww->charge,
            'type' => '-',
            'title' => 'Withdraw Via ' . $ww->method->name,
            'trx' => $ww->transaction_id
        ]);

        $text = $ww->amount . " - " . $basic->currency . " Withdraw Request Send via " . $ww->method->name . ". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
        notify($user, 'Withdraw Via ' . $ww->method->name, $text);
        return redirect()->route('withdraw.money')->with('success', 'Withdraw request Successfully Submitted. Wait For Confirmation.');

    }


}
