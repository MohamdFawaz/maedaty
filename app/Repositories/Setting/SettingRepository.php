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

    public function getAll(){
        $settings = Setting::get();
        $setting_list = [];
        foreach ($settings as $setting){
            $setting_list[$setting->key] = $setting->value;
        }
        return (object)$setting_list;
    }

    public function getSettingByKey($key){
        $value = Setting::where('key',$key)->pluck('value')->first();
        return $value;
    }

    public function updateSettings($input,$points_rules){
      if($this->flushSettings(array_keys($input))){
          foreach ($input as $key=>$val){
                Setting::create([
                    'key' => $key,
                    'value' => $val
                ]);
          }
        $this->updatePointsRules($points_rules);
        return true;
        }
    return false;
    }


    public function flushSettings($input){
        Setting::whereIn('key',$input)->delete();
        return true;
    }

    public function flushSettingByKey($key){
        Setting::where('key',$key)->delete();
        return true;
    }

    public function updatePointsRules($rules){
        $points = [];
        for ($i = 0; $i < count($rules['range']);$i++) {
            $value['range'] = $rules['range'][$i];
            $value['amount'] = $rules['amount'][$i];
            array_push($points,$value);
        }
        $this->flushSettingByKey('points');
        Setting::create([
            'key' => 'points',
            'value' => json_encode($points)
        ]);
        return true;
    }

}