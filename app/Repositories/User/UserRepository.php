<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\BaseRepository;
use App\Repositories\Address\AddressRepository;
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
    public $addressRepository;

    public function __construct(User $model,AddressRepository $addressRepository)
    {
        $this->model = $model;
        $this->addressRepository= $addressRepository;
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
            $data['user_image'] = $user['user_image'];
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
            $input['user_id'] = $user->id;
            //add new address with user id
            $this->addressRepository->createAddressFromSignup($input);
            return $input['jwt_token'];
        }

        return false;
    }
    public function update($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->phone = $input['phone'];
        $user->email = $input['email'];
        $user->location = $input['location'];
        $user->lat = $input['lat'];
        $user->lng = $input['lng'];
        if(isset($input['user_image'])){
            $user->user_image = $input['user_image'];
        }
        //If user saved successfully, then return true
        if ($user->save()) {
            $data['user_image'] = $user->user_image;
            return $data;
        }

        return false;
    }
    public function updatePassword($input)
    {
        $updated = false;
        $user = User::whereId($input['user_id'])->first();
        if(Hash::check($input['old_password'],$user->password)){
            $user->password = Hash::make($input['new_password']);
            $updated = $user->save();
        }
        //If user saved successfully, then return true
        if ($updated) {
            return true;
        }
        return false;
    }
    public function switchUserLanguage($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->lang = $input['lang'];
        //If user saved successfully, then return true
        if ($user->save()) {
            return true;
        }
        return false;
    }

    public function logoutUser($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->firebase_token = null;
        //If user saved successfully, then return true
        if ($user->save()) {
            return true;
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