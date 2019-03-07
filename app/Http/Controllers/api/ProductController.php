<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\SearchRequest;
use App\Models\UserCart\UserCart;
use App\Repositories\Shop\ShopRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\HotOffersProduct\HotOffersProduct;
use App\Repositories\Product\ProductRepository;


class ProductController extends APIController
{

    protected $productRepository;
    protected $lang;


    public function __construct(Request $request, ProductRepository $productRepository)
    {
        $this->lang = $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->productRepository = $productRepository;
    }


    public function index($category_id,$subcategory_id = null,$user_id = null,$cart_item_id = null){
        if($cart_item_id > 0){
            $cart_item = UserCart::where('id',$cart_item_id)->first();
            $data = $this->productRepository->getRelatedProductPaginate($cart_item->product->category_id,$cart_item->product->subcategory_id,$user_id,$cart_item->product->id);
        }else{
            $query = Product::where('category_id', $category_id);
            if($subcategory_id > 0){
                $query->where('subcategory_id',$subcategory_id);
            }
            $products = $query->with('hot_offer')->whereStatus(1)->get();
            $data = $this->productRepository->getAllProductsDetailPaginate($products,$user_id);
        }
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
            );
    }

    public function getShopProducts($shop_id,$category_id,$subcategory_id = null,$user_id = null){
        $query = Product::status()->with('hot_offer')->whereShopId($shop_id)->whereCategoryId($category_id)->whereStatus(1);
        if ($subcategory_id > 0){
            $query->whereSubcategoryId($subcategory_id);
        }
        $products = $query->get();
        $data = $this->productRepository->getAllProductsDetailPaginate($products,$user_id);
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
            );
    }



    public function searchForProducts(SearchRequest $request){
        $products= Product::status()->with('hot_offer')->whereStatus(1)
            ->whereTranslationLike('name','%'. $request->string .'%')
            ->orWhereTranslationLike('description', '%' . $request->string . '%')
            ->get();
        $data = $this->productRepository->getAllProductsDetailPaginate($products,$request->user_id);
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
            );
    }

    public function show($product_id, $user_id = null){
        $product = Product::with('hot_offer')->where('id',$product_id)->status()->first();
        $details['product'] = $this->productRepository->getProductDetails($product,$user_id);
        $details['related_products'] = $this->productRepository->getRelatedProduct($product->category_id,$product->subcategory_id,$user_id,$product_id);
        return $this->respond(
            200,
            trans('messages.products.page'),
            $details
            );
    }
    public function relatedProducts($cart_item_id){
        $cart_item = UserCart::with('hot_offer')->where('id',$cart_item_id)->first();
        $details['related_products'] = $this->productRepository->getRelatedProduct($cart_item->product->category_id,$cart_item->product->subcategory_id,$cart_item->user_id,$cart_item->product->id);
        return $this->respond(
            200,
            trans('messages.products.page'),
            $details
            );
    }

    public function hotOffers($user_id = null){
        $hot_offers = HotOffersProduct::where('from_date','<',Carbon::now()->toDateString())->where('to_date','>=',Carbon::now()->toDateString())->get();
        $data = $this->productRepository->getAllProductsDetailPaginateOffers($hot_offers,$user_id);
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
      );
    }

}
