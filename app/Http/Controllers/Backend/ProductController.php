<?php

namespace App\Http\Controllers\Backend;

use function App\Helpers\getRouteUrl;
use App\Models\Message\Message;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Setting\Setting;
use App\Models\User\User;
use App\Repositories\Setting\SettingRepository;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller
{


    public function index(){
        $products = Product::get();
        return view('backend.pages.product.index',compact('products'));
    }


}
