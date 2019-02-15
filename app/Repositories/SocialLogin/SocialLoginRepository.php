<?php

namespace App\Repositories\SocialLogin;

use App\Exceptions\GeneralException;
use App\Models\SocialLogin\SocialLogin;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
* Class NotificationRepository.
*/
class SocialLoginRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(SocialLogin $model)
    {
        $this->model = $model;
    }

    public function create(array $input)
    {
        $input['user_id'] = (User::max('id'))+1;
        //If user saved successfully, then return true
        if ($temp = SocialLogin::create($input)) {
            return $temp->id;
        }

        return false;
    }

    public function updateOrCreate(array $input)
    {
        $input['user_id'] = (User::max('id'))+1;
        
        //If user saved successfully, then return true
        if ($user = SocialLogin::updateOrCreate(
        [
            'auth_id' => $input['auth_id'],
            'provider' => $input['provider'],
        ],
        [
            'user_id'=>$input['user_id'],
            'profile_picture'=> $input['profile_picture'],
            'username'=> $input['username'],
            'email'=> $input['email']
        ]
        )) {
                   $user['was_changed'] = $user->wasChanged();
                   $user['was_created'] = $user->wasRecentlyCreated;

            return $user;
        }

        return false;
    }

}