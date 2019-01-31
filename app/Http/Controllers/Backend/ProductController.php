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
        $products = Product::with('shop')->get();
        return view('backend.pages.product.index',compact('products'));
    }


    public function show($product_id){
        $product = Product::with('shop','product_images','hot_offer')->where('id',$product_id)->first();
        return view('backend.pages.product.show',compact('product'));
    }
//['hot_offer' => function($query){
//    $query->where('from_date','<',Carbon::now()->toDateString());
//    $query->where('to_date','>=',Carbon::now()->toDateString());
//}]
    public function updateStatus(Request $request){
        $product = Product::whereId($request->product_id)->first();
        $product->status = $request->status;
        $product->save();
        $result = array(
            'success' => true,
            'status' => $product->status
        );
        return response()->json($result,200);
    }


}
