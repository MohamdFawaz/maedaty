<?php

namespace App\Repositories\Shop;

use App\Models\Shop\Shop;
use App\Models\Shop\ShopTranslation;
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


    public function getAll(){
        $shops = Shop::get();
        return $shops;
    }

    public function getShopById($shop_id){
        $shops = Shop::whereHas('user')->whereId($shop_id)->first();
        return $shops;
    }

    public function update($shop_id,$input){
        $shop = Shop::whereId($shop_id)->first();
        $shop->translate('en')->name = $input['name_en'];
        $shop->translate('ar')->name = $input['name_ar'];
        $shop->translate('en')->description = $input['description_en'];
        $shop->translate('ar')->description = $input['description_ar'];
        $shop->user_id = $input['owner_id'];
        if(isset($input['shop_image'])){
            $shop->image  = $input['shop_image'];
        }
        $shop->save();
        return true;
    }

    public function create($input){
        Shop::create([
            'user_id' => $input['owner_id'],
            'image' => $input['shop_image'],
            'ar' =>  ['name' => $input['name_ar'],'description' => $input['description_ar']],
            'en' =>  ['name' => $input['name_en'],'description' => $input['description_en']],
        ]);
        return true;
    }

    public function delete($shop_id){
        if(Shop::destroy($shop_id)){
            ShopTranslation::whereShopId($shop_id)->delete();
            return true;
        }
        return false;
    }

}