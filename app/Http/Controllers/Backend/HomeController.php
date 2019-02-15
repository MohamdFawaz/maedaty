<?php

namespace App\Http\Controllers\Backend;

use function App\Helpers\getRouteUrl;
use App\Models\Message\Message;
use App\Models\Order\Order;
use App\Models\Setting\Setting;
use App\Models\User\User;
use App\Repositories\Setting\SettingRepository;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use function Sodium\crypto_auth;

class HomeController extends Controller
{


    public function index(){
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

        return view('backend.pages.home.index',compact('total_orders','unconfirmed_orders','new_orders','onprogress_orders','delivered_orders','new_to_total_percentage','messages_count','activated_users'));
    }

    public function filterOrdersByDate(Request $request)
    {
        $fromDate = new Carbon($request->fromDate);
        $toDate = new Carbon($request->toDate);
        $orders = new Order();
        $total_orders = $orders->whereBetween('created_at',[$fromDate,$toDate])->count();
        $unconfirmed_orders = $orders->whereBetween('created_at',[$fromDate,$toDate])->where('order_status', 0)->count();
        $new_orders = $orders->whereBetween('created_at',[$fromDate,$toDate])->where('order_status', 1)->count();
        $onprogress_orders = $orders->whereBetween('created_at',[$fromDate,$toDate])->where('order_status', 2)->count();
        $delivered_orders = $orders->whereBetween('created_at',[$fromDate,$toDate])->where('order_status', 3)->count();
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

    public function getSalesLineChart()
    {
        $orders = new Order();
        $new=$orders->select(DB::raw('DATE(created_at) as date_created,count(*) as order_count'))->groupBy('date_created')->get();

        $arr = [
           'data' => $new
        ];
        return response()->json($arr);
    }
}
