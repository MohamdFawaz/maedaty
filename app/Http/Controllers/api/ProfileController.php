<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\ChangeLanguageRequest;
use App\Http\Requests\User\LogoutRequest;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\EditProfileRequest;
use App\Http\Requests\User\ChangePasswordRequest;

class ProfileController extends APIController
{


    protected $repository;

    public function __construct(Request $request, UserRepository $repository)
    {
        $this->repository = $repository;
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
    }



    public function show($user_id){
        $user = User::whereId($user_id)->first();
        $user_details = $this->repository->getLoggedUserDetails($user);
        return $this->respond(
            200,
            trans('messages.profile.user_details'),
            $user_details
            );
    }

    public function edit(EditProfileRequest $request){
        $updated_profile = $this->repository->update($request->except('jwt_token'));
        if($updated_profile){
           return $this->respond(
               200,
               trans('messages.profile.updated'),
               $updated_profile
           );
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }
    public function changePassword(ChangePasswordRequest $request){
        if($request->old_password == $request->new_password){
            return $this->respondWithError(trans('messages.profile.old_password_same_as_new'));
        }
        $updated_password = $this->repository->updatePassword($request->except('jwt_token'));
        if($updated_password){
           return $this->respondWithMessage(trans('messages.profile.password_updated'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }
    public function changeLanguage(ChangeLanguageRequest $request){
        $updated_lang = $this->repository->switchUserLanguage($request->except('jwt_token'));
        if($updated_lang){
           return $this->respondWithMessage(trans('messages.profile.lang_updated'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }
    public function logout(LogoutRequest $request){
        $loggedout = $this->repository->logoutUser($request->except('jwt_token'));
        if($loggedout){
           return $this->respondWithMessage(trans('messages.profile.logged_out'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }

}
