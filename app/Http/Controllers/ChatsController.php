<?php

namespace App\Http\Controllers;

use App\BitJob;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\MessageSent;
use PhpParser\Node\Stmt\Return_;
use Validator;


class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
         $checkCode = BitJob::whereCode($code)->first();

        if ($checkCode) {
            $user1 = $checkCode->author_id;
             $user2 = $checkCode->user_id;
             $project_id = $checkCode->project_id;
            $data['messages'] = Message::where('user_id', $user1)->where('receiver_id', $user2)->where('project_id',$project_id)->
            orWhere(function ($query) use ($user1, $user2,$project_id) {
                $query->where('user_id', $user2)->where('receiver_id', $user1)->where('project_id',$project_id);
            })->get();



            $data['page_title'] = "Chatting";

            $data['receiver_id'] = (Auth::id() != $user2) ? $user2 :$user1;
            $data['project_id'] = $checkCode->project_id;
            $data['betjob_id'] = $checkCode->id;
            $data['receiver_name'] =  "Message For ". $checkCode->project->title ;
            $data['code'] = $checkCode->code;


            $updateMesasge = Message::where('bit_job_id', $checkCode->id)->where('receiver_id', Auth::user()->id)->where('project_id',$checkCode->project_id)->get();
            foreach ($updateMesasge as $msg) {
                $msg->is_read = 1;
                $msg->save();
            }

            return view('chat.index', $data);
        }
        abort(404);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'receiver_id' => 'required'
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data['msg'] = Message::create([
            'message' => $request->message,
            'receiver_id' => $request->receiver_id,
            'project_id' => $request->project_id,
            'bit_job_id' => $request->betjob_id,
            'user_id' => Auth::user()->id
        ]);
        if (isset($data['msg'])) {
            $data['ok'] = 'success';
        } else {
            $data['ok'] = 'no_success';
        }
        return $data;
    }

    public function getChat(Request $request)
    {
        $user1 = $request->user;
        $user2 = $request->receiver;
        $project_id = $request->project;
        $id = $request->length;
        $item = Message::with('receiver', 'user')->where('id', '>', $id)->where('project_id',$project_id)->where('user_id', $user1)->where('receiver_id', $user2)->
        orWhere(function ($query) use ($user1, $user2, $id, $project_id) {
            $query->where('id', '>', $id)->where('user_id', $user2)->where('receiver_id', $user1)->where('project_id',$project_id);
        })->where('id', '>', $id)->get();

        return $item;
    }

    public function messageslist()
    {
         $user = Auth::id();
          $data['messages'] = Message::where('receiver_id',$user)->orWhere('user_id', $user)->distinct()->get(['bit_job_id']);
        $data['page_title'] = "Messages";
        return view('chat.messagelist', $data);
    }

}
