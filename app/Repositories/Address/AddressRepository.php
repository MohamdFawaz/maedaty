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


    public function create($input){
        if(Address::create($input)){
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
            $address_item['first_name'] = $address->first_name;
            $address_item['last_name'] = $address->last_name;
            $address_item['phone'] = $address->phone;
            $address_item['address'] = $address->address;
            $address_list[] = $address_item;
        }
        return $address_list;
    }
}