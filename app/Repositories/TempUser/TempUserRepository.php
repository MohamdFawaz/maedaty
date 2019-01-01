<?php

namespace App\Repositories\TempUser;

use App\Exceptions\GeneralException;
use App\Models\TempUser\TempUser;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
* Class NotificationRepository.
*/
class TempUserRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(TempUser $model)
    {
        $this->model = $model;
    }

    public function create(array $input)
    {

        //If user saved successfully, then return true
        if ($temp = TempUser::create($input)) {
            return $temp->id;
        }

        return false;
    }

}