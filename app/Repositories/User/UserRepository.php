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
        $data['first_name'] = $user['first_name'];
        $data['last_name'] = $user['last_name'];
        $data['phone'] = $user['phone'];
        $data['email'] = $user['email'];
        $data['user_image'] = $user['user_image'];
        $data['jwt_token'] = $user['jwt_token'];
        $data['location'] = $user['location'];
        $data['lat'] = $user['lat'];
        $data['lng'] = $user['lng'];
        return $data;
    }

    public function create(array $input)
    {
        $input['password'] = Hash::make($input['password']);
        $input['jwt_token'] = str_random(25);

        //If user saved successfully, then return true
        if ($user = User::create($input)) {
            return $input['jwt_token'];
        }

        return false;
    }
}