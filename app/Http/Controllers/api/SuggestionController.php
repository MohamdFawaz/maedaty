<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Suggestion\StoreSuggestionRequest;
use App\Models\Suggestion\Suggestion;
use Illuminate\Http\Request;


class SuggestionController extends APIController
{


    protected $repository;

    public function __construct(Request $request)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
    }

    public function store(StoreSuggestionRequest $request){
        $new_suggestions = Suggestion::create([
            'user_id' => $request->user_id,
            'comment' => $request->comment
        ]);
        if($new_suggestions){
            return $this->respondWithMessage(trans('messages.suggestion.added'));
        }else{
            return $this->respondWithMessage(trans('messages.something_went_wrong'));
        }
    }


}
