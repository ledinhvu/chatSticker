<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use App\Repositories\RoomsRepository;
use App\Repositories\MessagesRepository;
use DB;
use App\Models\Rooms;
use App\Models\User;
use App\Models\Messages;
use Flash;
use Auth;

class LoginChatController extends AppBaseController
{
    /** @var  userRepository */
    private $userRepository;

    /** @var  roomsRepository */
    private $roomsRepository;

    /** @var  messagesRepository */
    private $messagesRepository;

    public function __construct(UserRepository $userRepo, RoomsRepository $roomsRepo
    , MessagesRepository $messagesRepo)
    {
        $this->userRepository = $userRepo;
        $this->roomsRepository = $roomsRepo;
        $this->messagesRepository = $messagesRepo;
    }

    public function index()
    {
        return view('frontend.login.login');

    }

    public function login(LoginRequest $request)
    {
        if($this->userRepository->userLogin($request->all())){
            return redirect(route('choiceRoom'));
        }else {
            Flash::error('Email or Password does not exist');
            return $this->index();
        }

    }

    public function choice(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_room = DB::table('user_room')->select('id_room')->where('id_user', $id_user)->get();
        $arr = array_pluck($id_room, 'id_room');

        if(Auth::user()->role == 1){
            $rooms = $this->roomsRepository->all();
        }else {
            $rooms = DB::table('rooms')->whereIn('id', $arr)->orWhere('role', '1')->get();
        }
        return view('frontend.login.roomChat', compact('rooms'));
    }

    public function joinroom(Request $request, $id)
    {
        $messages = Messages::where('id_room', $id)->get();
        $id_user = Auth::user()->id;
        $check = DB::table('user_room')->where('id_user', '=', $id_user)
        ->where('id_room', '=', $id)->get();
        $data = array('id_user' => $id_user, 'id_room' => $id);
        if($check->isEmpty())
        {
            DB::table('user_room')->insert($data);
        }
       return view('frontend.login.joinroom', compact('messages', 'id'));
    }

    public function choosemem(Request $request, $id)
    {
        $id_user = DB::table('user_room')->select('id_user')->where('id_room', $id)->get();
        $arr = $id_user->toArray();
        $arr1 = array_pluck($arr, 'id_user');
        
        $users = DB::table('users')->whereNotIn('id', $arr1)->get();
        return view('frontend.login.addmember', compact('users'));
    }

    public function addmem(Request $request)
    {
        dd($request['check_list']);
    }

}
