<?php

namespace App\Http\Controllers;

use App\BitJob;
use App\Feature;
use App\Project;
use App\Slider;
use App\Subscriber;
use App\Testimonial;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Menu;
use App\Faq;
use App\Advertisment;

class FrontendController extends Controller{


    public function index()
    {
        $data['page_title'] = "Home";
        $data['jobs'] =  Project::count();
        $data['freelancer'] =  User::where('type',1)->count();
        $data['employer'] =  User::where('type',2)->count();
        $data['sliders'] =  Slider::latest()->get();
        $data['features'] =  Feature::all();

        $data['bitJob'] =  BitJob::where('created_at',Carbon::today())->count();
        $data['testimonials'] =  Testimonial::latest()->take(3)->get();
        return view('front.index',$data);
    }





    public function menu($slug)
    {
        $menu = $data['menu'] =  Menu::whereSlug($slug)->first();
        $data['page_title'] = "$menu->name";
        return view('layouts.menu',$data);
    }
    public function about()
    {
        $data['page_title'] = "About Us";
        return view('layouts.about',$data);
    }

    public function faqs()
    {
        $data['faqs'] =  Faq::all();
        $data['page_title'] = "Faqs";
        return view('layouts.faqs',$data);
    }


    public function contactUs()
    {
        $data['page_title'] = "Contact Us";
        return view('layouts.contact',$data);
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        $subject = "Contact Us";
        send_email($request->email,$request->name, $subject,$request->message);
        $notification =  array('message' => 'Contact Message Send.', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function clickadd($id){

        $add = Advertisment::findOrFail($id);
        $data = array();
        $data['views'] = $add->views+1;
        Advertisment::whereId($id)->update($data);
        $go = $add->link;
        return redirect($go);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $macCount = Subscriber::where('email', $request->email)->count();
        if ($macCount > 0) {
            return back()->with('alert', 'This Email Already Exist !!');
        }else{
            Subscriber::create($request->all());
            return back()->with('success', ' Subscribe Successfully!');
        }
    }
}
