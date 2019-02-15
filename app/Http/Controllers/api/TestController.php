<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Address\EditAddressRequest;
use Illuminate\Http\Request;
use App\Models\Address\Address;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\DeleteAddressRequest;
use App\Repositories\Address\AddressRepository;

class TestController extends APIController
{

    public static $SUCCESS = 200;


}
