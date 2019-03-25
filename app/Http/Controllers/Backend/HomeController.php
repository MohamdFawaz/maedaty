<?php

namespace App\Http\Controllers\Backend;

use App\Models\Message\Message;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\User\User;
use App\Repositories\Order\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
//        $permission = Permission::create(['name'=>'show orders on dashboard']);
//        $role->givePermissionTo($permission);
        if(Auth::user()->hasRole('Super Admin')){
            $orders = new Order();
            $total_orders = $orders->count();
            $unconfirmed_orders = $orders->where('order_status',0)->count();
            $new_orders = $orders->where('order_status',1)->count();
            $onprogress_orders = $orders->where('order_status',2)->count();
            $delivered_orders = $orders->where('order_status',3)->count();
            $new_to_total_percentage = floor($new_orders/$total_orders);
            $messages = new Message();
            $messages_count = $messages->where('user','!=', 'admin')->where('message_read',0)->count(); // TODO change id with auth user id
            $users = new User();
            $activated_users = $users->where('user_status', 1)->where('role_id',2)->count();
            $products = new Product();
            $products = $products->where('status',1)->count();
        }elseif(Auth::user()->hasRole('Store Admin')){
            $orders = new Order();
            $products = Product::where('shop_id',Auth::user()->shop->id)->pluck('id')->toArray();
            $store_orders = $this->repository->getProductStoreId($products,$orders->get());
            $total_orders = $orders->whereIn('id',$store_orders)->count();
            $unconfirmed_orders = $orders->whereIn('id',$store_orders)->where('order_status',0)->count();
            $new_orders = $orders->whereIn('id',$store_orders)->where('order_status',1)->count();
            $onprogress_orders = $orders->whereIn('id',$store_orders)->where('order_status',2)->count();
            $delivered_orders = $orders->whereIn('id',$store_orders)->where('order_status',3)->count();
            $new_to_total_percentage = floor($new_orders/$total_orders);
            $products = new Product();
            $products = $products->where('status',1)->where('shop_id',Auth::user()->shop->id)->count();
        }
        return view('backend.pages.home.index',compact('total_orders','unconfirmed_orders','new_orders','onprogress_orders','delivered_orders','new_to_total_percentage','messages_count','activated_users','products'));
    }

    public function filterOrdersByDate(Request $request)
    {
        if(Auth::user()->hasRole('Super Admin')) {
            $fromDate = new Carbon($request->fromDate);
            $toDate = new Carbon($request->toDate);
            $orders = new Order();
            $total_orders = $orders->whereBetween('created_at', [$fromDate, $toDate])->count();
            $unconfirmed_orders = $orders->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 0)->count();
            $new_orders = $orders->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 1)->count();
            $onprogress_orders = $orders->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 2)->count();
            $delivered_orders = $orders->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 3)->count();
            $new_to_total_percentage = floor($new_orders / ($total_orders == 0 ? 1 : $total_orders));
            $arr = [
                'total_orders' => $total_orders,
                'unconfirmed_orders' => $unconfirmed_orders,
                'new_orders' => $new_orders,
                'onprogress_orders' => $onprogress_orders,
                'delivered_orders' => $delivered_orders,
                'new_to_total_percentage' => $new_to_total_percentage
            ];
            return response()->json($arr);
        }elseif (Auth::user()->hasRole('Store Admin')){
            $fromDate = new Carbon($request->fromDate);
            $toDate = new Carbon($request->toDate);
            $orders = new Order();
            $products = Product::where('shop_id',Auth::user()->shop->id)->pluck('id')->toArray();
            $store_orders = $this->repository->getProductStoreId($products,$orders->get());
            $total_orders = $orders->whereIn('id', $store_orders)->whereBetween('created_at', [$fromDate, $toDate])->count();
            $unconfirmed_orders = $orders->whereIn('id', $store_orders)->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 0)->count();
            $new_orders = $orders->whereIn('id', $store_orders)->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 1)->count();
            $onprogress_orders = $orders->whereIn('id', $store_orders)->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 2)->count();
            $delivered_orders = $orders->whereIn('id', $store_orders)->whereBetween('created_at', [$fromDate, $toDate])->where('order_status', 3)->count();
            $new_to_total_percentage = floor($new_orders / ($total_orders == 0 ? 1 : $total_orders));
            $arr = [
                'total_orders' => $total_orders,
                'unconfirmed_orders' => $unconfirmed_orders,
                'new_orders' => $new_orders,
                'onprogress_orders' => $onprogress_orders,
                'delivered_orders' => $delivered_orders,
                'new_to_total_percentage' => $new_to_total_percentage
            ];
            return response()->json($arr);
        }
        return 1;
    }

    public function getSalesLineChart()
    {
        if(Auth::user()->hasRole('Super Admin')) {
            $orders = new Order();
            $new = $orders->select(DB::raw('DATE(created_at) as date_created,count(*) as order_count'))->groupBy('date_created')->get();
            $orderAddresses = $orders->whereHas('address')->groupBy('delivery_address_id')->get();
            $countries = [];
            foreach ($orderAddresses as $orderAddress) {
                $country['name'] = $this->getCountryName($orderAddress->address->lat, $orderAddress->address->lng);
                $country['latLng'] = [(string)round($orderAddress->address->lat, 2), (string)round($orderAddress->address->lng, 2)];
                if ($this->is_in_array($countries, 'name', $country['name']) == 'no') {
                    array_push($countries, $country);
                }
            }
            $arr = [
                'data' => $new,
                'country' => $countries
            ];
            return response()->json($arr);

        }elseif (Auth::user()->hasRole('Store Admin')){
            $orders = new Order();
            $products = Product::where('shop_id',Auth::user()->shop->id)->pluck('id')->toArray();
            $store_orders = $this->repository->getProductStoreId($products,$orders->get());
            $new = $orders->select(DB::raw('DATE(created_at) as date_created,count(*) as order_count'))->whereIn('id',$store_orders)->groupBy('date_created')->get();
            $orderAddresses = $orders->whereIn('id',$store_orders)->whereHas('address')->groupBy('delivery_address_id')->get();
            $countries = [];
            foreach ($orderAddresses as $orderAddress) {
                $country['name'] = $this->getCountryName($orderAddress->address->lat, $orderAddress->address->lng);
                $country['latLng'] = [(string)round($orderAddress->address->lat, 2), (string)round($orderAddress->address->lng, 2)];
                if ($this->is_in_array($countries, 'name', $country['name']) == 'no') {
                    array_push($countries, $country);
                }
            }
            $arr = [
                'data' => $new,
                'country' => $countries
            ];
            return response()->json($arr);
        }
        return 0;
    }

    public function getMapCountries($lat,$lng)
    {
        $country = $this->getCountryName($lat,$lng);
        return response()->json($country);
    }

    public function getCountryName($lat,$lng){
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false&key=AIzaSyDhnmMC23noePz6DA8iEvO9_yNDGGlEaeM');
        $output= json_decode($geocode);
        for($j=0;$j<count($output->results[0]->address_components);$j++){

            $cn=array($output->results[0]->address_components[$j]->types[0]);

            if(in_array("country", $cn)){
                $country= $output->results[0]->address_components[$j]->long_name;
            }
        }

        return $country ;
    }
    public function is_in_array($array, $key, $key_value)
    {
        $within_array = 'no';
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $within_array = $this->is_in_array($v, $key, $key_value);
                if ($within_array == 'yes') {
                    break;
                }
            } else {
                if ($v == $key_value && $k == $key) {
                    $within_array = 'yes';
                    break;
                }
            }
        }
        return $within_array;
    }
}
