<?php

namespace App\Repositories\Setting;

use App\Models\Setting\Setting;
use App\Models\UserFavorite\UserFavorite;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepository;
use Hamcrest\Core\Set;


/**
* Class NotificationRepository.
*/
class SettingRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function getSettingByKey($key){
        $value = Setting::where('key',$key)->pluck('value')->first();
        return $value;
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