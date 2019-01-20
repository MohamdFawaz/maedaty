<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Suggestion\StoreSuggestionRequest;
use App\Models\Suggestion\Suggestion;
use App\Repositories\Suggestion\SuggestionRepository;
use Illuminate\Http\Request;


class SuggestionController extends APIController
{


    protected $repository;

    public function __construct(Request $request, SuggestionRepository $repository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;
    }

    public function store(StoreSuggestionRequest $request){
        $this->repository->create($request->except('jwt_token'));
        return $this->respondWithMessage(trans('messages.suggestion.added'));
    }


}
