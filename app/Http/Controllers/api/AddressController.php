<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Address\EditAddressRequest;
use Illuminate\Http\Request;
use App\Models\Address\Address;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\DeleteAddressRequest;
use App\Repositories\Address\AddressRepository;

class AddressController extends APIController
{


    protected $repository;

    public function __construct(Request $request, AddressRepository $repository)
    {
        $this->repository = $repository;
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
    }


    public function index(){
        $addresses= Address::all();
        return $this->respond(
            200,
            trans('messages.address.list'),
            $addresses
            );
    }

    public function show($user_id){
        $addresses = $this->repository->getAllUserAddress($user_id);
        $data = $this->repository->getAllAddressDetails($addresses);
        return $this->respond(
            200,
            trans('messages.address.list'),
            $data
            );
    }

    public function store(StoreAddressRequest $request){
        $new_address = $this->repository->create($request->except('jwt_token'));
        if($new_address){
           return $this->respondWithMessage(trans('messages.address.added'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }
    public function edit(EditAddressRequest $request){
        $updated_address = $this->repository->update($request->except('jwt_token'));
        if($updated_address){
           return $this->respondWithMessage(trans('messages.address.updated'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }

    public function destroy(DeleteAddressRequest $request)
    {
        $deleted = $this->repository->delete($request->address_id);
        if($deleted){
            return $this->respondWithMessage(trans('messages.address.removed'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }
}
