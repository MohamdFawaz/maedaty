<?php

namespace App\Repositories\ShopBranch;

use App\Models\Shop\ShopBranches;
use App\Repositories\BaseRepository;

/**
* Class NotificationRepository.
*/
class ShopBranchRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(ShopBranches $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        $branches = ShopBranches::get();
        return $branches;
    }

    public function getBranchById($branch_id){
        $branch = ShopBranches::whereId($branch_id)->first();
        return $branch;
    }

    public function update($branch_id,$input){
        ShopBranches::whereId($branch_id)->update($input);
        return true;
    }

    public function create($input){
        ShopBranches::create($input);
        return true;
    }

    public function delete($branch_id){
        if(ShopBranches::destroy($branch_id)){
            return true;
        }
        return false;
    }

}