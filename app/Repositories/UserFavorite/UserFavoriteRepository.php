<?php

namespace App\Repositories\UserFavorite;

use App\Models\UserFavorite\UserFavorite;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepository;


/**
* Class NotificationRepository.
*/
class UserFavoriteRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;
    public $productRepository;


    public function __construct(UserFavorite $model,ProductRepository $productRepository)
    {
        $this->model = $model;
        $this->productRepository = $productRepository;
    }

    public function getUserFavorites($favorites,$user_id = null){
        $favorites_item = [];
        $favorites_list = [];

        foreach ($favorites as $favorite){
            $favorites_item = $this->productRepository->getProductDetails($favorite->product,$user_id);
            $favorites_list[] = $favorites_item;
        }
        return $favorites_list;
    }

    public function create($input){
        if(UserFavorite::create($input)){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(UserFavorite::destroy($input)){
            return true;
        }
        return false;
    }

}