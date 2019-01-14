<?php

namespace App\Http\Controllers\api;

use App\Repositories\UserFavorite\UserFavoriteRepository;
use Illuminate\Http\Request;
use App\Models\Address\UserFavorite;
use App\Http\Requests\UserFavorite\StoreFavoriteRequest;

class UserFavoriteController extends APIController
{

    protected $repository;


    public function __construct(Request $request, UserFavoriteRepository $repository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;

    }


    public function index($user_id){
        $favorites = UserFavorite::where('user_id',$user_id)->latest()->get();
        $data['data'] = $this->repository->getUserFavorites($favorites,$user_id);
        return $this->respond(
            200,
            trans('messages.favorites.list'),
            $data
            );
    }

    public function store(StoreFavoriteRequest $request){
        $checkExists = UserFavorite::where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
        if(!$checkExists){
            if($this->repository->create($request->only('user_id','product_id'))){
                $message = trans('messages.favorites.added');
            }
        }else{
            if($this->repository->delete($checkExists->id)){
                $message = trans('messages.favorites.removed');
            }
        }
        return $this->respondWithMessage($message);
    }


}
