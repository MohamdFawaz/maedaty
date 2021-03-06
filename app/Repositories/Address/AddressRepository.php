<?php

namespace App\Repositories\Address;

use App\Models\Address\Address;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepository;


/**
* Class NotificationRepository.
*/
class AddressRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(Address $model)
    {
        $this->model = $model;
    }


    public function getAllUserAddress($user_id){
        $addresses= Address::where('user_id',$user_id)->latest()->get();
        return $addresses;
    }

    public function create($input){
        if(Address::create($input)){
            return true;
        }
        return false;
    }
    public function createAddressFromSignup($input){
        $input['address'] = $input['location'];
        if(Address::create($input)){
            return true;
        }
        return false;
    }
    public function update($input){
        $address = Address::whereId($input['address_id'])->first();
        $address->first_name = $input['first_name'];
        $address->last_name = $input['last_name'];
        $address->phone= $input['phone'];
        $address->address= $input['address'];
        $address->lat= $input['lat'];
        $address->lng= $input['lng'];
        if($address->save()){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(Address::destroy($input)){
            return true;
        }
        return false;
    }
    public function getAllAddressDetails($addresses)
    {
        $address_list = [];
        $address_item = [];
        foreach ($addresses as $address){
            $address_item['id'] = $address->id;
            $address_item['first_name'] = $address->first_name;
            $address_item['last_name'] = $address->last_name;
            $address_item['phone'] = $address->phone;
            $address_item['address'] = $address->address;
            $address_item['lat'] = $address->lat;
            $address_item['lng'] = $address->lng;
            $address_list[] = $address_item;
        }
        return $address_list;
    }
}