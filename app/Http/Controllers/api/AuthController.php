<?php

namespace App\Http\Controllers\api;

use App\Models\User\User;
use App\Repositories\TempUser\TempUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Helper;

class AuthController extends APIController
{
    protected $repository;
    protected $tempUserRepository;

    /**
     * __construct.
     *
     * @param $repository
     * @param $request
     * @param $tempUserRepository
     */
    public function __construct(UserRepository $repository, Request $request, TempUserRepository $tempUserRepository)
    {
        $this->repository = $repository;
        $this->setLang($request->header('lang'));
        $this->tempUserRepository = $tempUserRepository;
    }
    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $credentials = $request->only(['phone', 'password']);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->firebase_token = $request->firebase_token;
            $user->jwt_token = str_random(25);
            $user->save();
            return $this->respond(
                trans('status.success'),
                trans('login.user_logged_in'),
                $this->repository->getLoggedUserDetails($user)
            );
        }
        $token = "";
        return $this->respond(
            'success',
            trans('api.messages.login.success'),
            $token
        );
    }

    /**
     * Signup the user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        if($user['jwt_token'] = $this->repository->create($request->all())){

            return $this->respond(
                trans('status.success'),
                trans('login.user_logged_in'),
                $user
            );
        }
        $token = "";
        return $this->respond(
            'success',
            trans('api.messages.login.success'),
            $token
        );
    }

    public function tempUser(Request $request){
        $validation = Validator::make($request->all(), [
            'device_id' => 'required',
            'firebase_token' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $message['user_id'] = $this->tempUserRepository->create($request->all());
        return $this->respond(trans('status.success'),trans('status.success'), $message);
    }
}
