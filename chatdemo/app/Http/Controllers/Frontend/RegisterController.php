<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Flash;
use Response;

class RegisterController extends AppBaseController
{
    /** @var  userRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Store a newly created rooms in storage.
     *
     * @param CreateuserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->userRepository->registerUser($request->all());
        Flash::success('Create user successfully');
        return redirect(route('loginChat'));

    }
}
