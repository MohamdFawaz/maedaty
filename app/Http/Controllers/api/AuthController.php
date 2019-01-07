<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\SocialLoginRequest;
use App\Models\User\User;
use App\Models\SocialLogin\SocialLogin;
use App\Repositories\TempUser\TempUserRepository;
use App\Repositories\SocialLogin\SocialLoginRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use JWTAuth;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SignupRequest;
use Validator;
use Helper;

class AuthController extends APIController
{
    protected $repository;
    protected $tempUserRepository;
    protected $socialLoginRepository;

    /**
     * __construct.
     *
     * @param $repository
     * @param $request
     * @param $tempUserRepository
     * @param $socialLoginRepository
     */
    public function __construct(UserRepository $repository, Request $request, tempUserRepository $tempUserRepository, socialLoginRepository $socialLoginRepository)
    {
        $this->repository = $repository;
        $this->setLang($request->header('lang'));
        $this->tempUserRepository = $tempUserRepository;
        $this->socialLoginRepository = $socialLoginRepository;
        $request->headers->set('Accept', 'application/json');

    }
    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['phone', 'password']);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->firebase_token = $request->firebase_token;
            $user->jwt_token = str_random(25);
            $user->save();
            return $this->respond(
                200,
                trans('login.user_logged_in'),
                $this->repository->getLoggedUserDetails($user)
            );
            }else{
                return $this->respondUnauthorized(trans('messages.auth.wrong_phone_password'));
            }
    }


    /**
     * Signup the user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(SignupRequest $request)
    {


        if($user['jwt_token'] = $this->repository->create($request->all())){

            return $this->respond(
                200,
                trans('messages.signup.created'),
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

    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function test(LoginRequest $request)
    {
        $credentials = $request->only(['phone', 'password']);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->firebase_token = $request->firebase_token;
            $user->jwt_token = str_random(25);
            $user->save();
            return $this->respond(
                trans('status.success'),
                trans('messages.signup.created'),
                $this->repository->getLoggedUserDetails($user)
            );
        }else{
            return $this->respondUnauthorized(trans('messages.auth.wrong_phone_password'));
        }
    }/**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function socialLogin(SocialLoginRequest $request)
    {
        $user = $this->socialLoginRepository->updateOrCreate($request->all());
        if($user->was_created){
            $data = $this->repository->createSocial($user);
            if($data){
                return $this->respond(200,trans('login.user_logged_in'),$data);
            }else{
                return $this->respondWithError(trans('login.user_logged_in'));
            }
        }
        return $this->respond(200,trans('login.user_logged_in'),$user);
    }

}
