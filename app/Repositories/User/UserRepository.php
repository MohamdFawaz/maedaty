<?php

namespace App\Repositories\User;

use App\Exceptions\GeneralException;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
* Class NotificationRepository.
*/
class UserRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getLoggedUserDetails($user)
    {
        $data['id'] = $user['id'];
        $data['first_name'] = ucwords($user['first_name']);
        $data['last_name'] = ucwords($user['last_name']);
        $data['phone'] = $user['phone'];
        $data['email'] = $user['email'];
        if($user->socialaccount){
            $data['user_image'] = $user->socialaccount->profile_picture;
        }else{
            $data['user_image'] = $this->model->getUseImageAttribute($user['user_image']);
        }
        $data['jwt_token'] = $user['jwt_token'];
        $data['location'] = $user['location'];
        $data['lat'] = $user['lat'];
        $data['lng'] = $user['lng'];
        return $data;
    }

    public function create(array $input)
    {
        $input['password'] = (isset($input['password']))? Hash::make($input['password']) : "";
        $input['jwt_token'] = str_random(25);

        //If user saved successfully, then return true
        if ($user = User::create($input)) {
            return $input['jwt_token'];
        }

        return false;
    }
    public function createSocial($input)
    {
        $fullname = explode(' ', $input->username);
        $input['first_name'] = $fullname[0];
        $input['last_name'] = $fullname[1];
        $input['jwt_token'] = str_random(25);
        $input['socialaccount']= (object)['profile_picture' => $input['profile_picture']];
        if(User::find($input['email']) === null){
            //If user saved successfully, then return true
            $createUser = User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'user_status' => 1,
                'jwt_token' => $input['jwt_token']
            ]);
            if ($createUser) {
                return $this->getLoggedUserDetails($input);
            }
        }


        return false;
    }
}