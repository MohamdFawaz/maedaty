<?php

namespace App\Repositories\Cart;

use App\Models\Cart\Cart;
use App\Repositories\BaseRepository;

/**
* Class NotificationRepository.
*/
class CartRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

    public function create($input){
        if(Cart::create($input)){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(Cart::destroy($input)){
            return true;
        }
        return false;
    }

}