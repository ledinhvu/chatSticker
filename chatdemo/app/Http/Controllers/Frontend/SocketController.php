<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LRedis;
use DB;
use Auth;
use App\Models\Messages;
use App\Models\Images;
use Reponse;

class SocketController extends Controller {
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function writemessage(Request $request)
    {
        return view('frontend.login.joinroom');
    }

    public function sendMessage(Request $request){
        $content = e($request->input('message'));
        $main_content = $this->changeImg($content);
        $message = Messages::create([
            'content' => $main_content,
            'id_user' => Auth::user()->id,
            'id_room' => $request->input('id_room')
        ]);
        $message2 = Messages::with('user')->orderBy('id', 'desc')->first();
        $redis = LRedis::connection();
        $redis->publish('message', $message2);
        return response()->json($message);
    }

    public function changeImg($content)
    {
        $arrStr = explode(':', $content);
        foreach($arrStr as $value) {
            if(strlen($value) > 0){
                $sub = ":".$value.":";
                $image = images::where('key', $sub)->first();
                if(!empty($image)){
                    $str = str_replace($sub,$image->url,$content);
                }
            } else {
                continue;
            }
        }
        return $str;
    }
}