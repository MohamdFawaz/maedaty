<?php

namespace App\Repositories\Suggestion;

use App\Models\Suggestion\Suggestion;
use App\Repositories\BaseRepository;


/**
* Class NotificationRepository.
*/
class SuggestionRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(Suggestion $model)
    {
        $this->model = $model;
    }


    public function getAll(){
        $suggestions = Suggestion::get();
        return $suggestions;
    }


    public function create($input){
        if(Suggestion::create($input)){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(Suggestion::destroy($input)){
            return true;
        }
        return false;
    }

}