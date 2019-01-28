<?php

namespace App\Repositories\Shop;

use App\Models\Shop\Shop;
use App\Models\UserReview\UserReview;
use App\Repositories\BaseRepository;

/**
* Class NotificationRepository.
*/
class ShopRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(Shop $model)
    {
        $this->model = $model;
    }

    public function getShopDetails($shops){
        $shop_list = [];
        $shop_item = [];
        foreach ($shops as $shop){
            $shop_item['id'] = $shop->id;
            $shop_item['name'] = $shop->name;
            $shop_item['description'] = $shop->description;
            $shop_item['image'] = $shop->image;
            $shop_item['branches'] = $this->getShopBranches($shop->shop_branches);
            $shop_list[] = $shop_item;

        }
        return $shop_list;
    }
    public function getShopBranches($shop_branches){
        $shop_branches_list = [];
        $shop_branches_item = [];
        foreach ($shop_branches as $shop_branch){
            $shop_branches_item['shop_id'] = $shop_branch->shop_id;
            $shop_branches_item['address'] = $shop_branch->address;
            $shop_branches_item['lat'] = $shop_branch->lat;
            $shop_branches_item['lng'] = $shop_branch->lng;
            $shop_branches_list[] = $shop_branches_item;
        }
        return $shop_branches_list;
    }


    public function create($input){
        if(UserReview::create($input)){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(UserReview::destroy($input)){
            return true;
        }
        return false;
    }

}