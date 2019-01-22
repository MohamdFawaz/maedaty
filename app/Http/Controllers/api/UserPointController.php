<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\UserPoint\RedeemUserPointRequest;
use App\Models\UserPoint\UserPoint;
use App\Repositories\UserPoint\UserPointRepository;
use Illuminate\Http\Request;


class UserPointController extends APIController
{


    protected $repository;

    public function __construct(Request $request, UserPointRepository $repository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;
    }

    public function store(RedeemUserPointRequest $request){

        $this->repository->update($request->except('jwt_token'));
        return $this->respondWithMessage(trans('messages.suggestion.added'));
    }


}
