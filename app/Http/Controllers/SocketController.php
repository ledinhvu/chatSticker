<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use LRedis;
use Illuminate\Http\Request;

class SocketController extends Controller {
    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function index()
    {
        return view('socket');
    }

    public function writemessage(Request $request)
    {
        return view('writemessage');
    }

    public function sendMessage(Request $request){
        $redis = LRedis::connection();
        $redis->publish('message', $request->input('message'));
        return redirect('writemessage');
    }
}