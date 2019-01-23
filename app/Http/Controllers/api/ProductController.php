<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\HotOffersProduct\HotOffersProduct;
use App\Repositories\Product\ProductRepository;


class ProductController extends APIController
{

    protected $productRepository;


    public function __construct(Request $request, ProductRepository $productRepository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->productRepository = $productRepository;

    }


    public function index($category_id,$subcategory_id = null,$user_id = null){
        $query = Product::where('category_id', $category_id);
        if($subcategory_id){
            $query->where('subcategory_id',$subcategory_id);
        }
        $products = $query->whereStatus(1)->get();
        $data = $this->productRepository->getAllProductsDetailPaginate($products,$user_id);
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
            );
    }
    public function getShopProducts($shop_id,$user_id = null){
        $products= Product::where('shop_id', $shop_id)->whereStatus(1)->get();
        $data = $this->productRepository->getAllProductsDetailPaginate($products,$user_id);
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
            );
    }

    public function show($product_id, $user_id = null){
        $product = Product::where('id',$product_id)->whereStatus(1)->first();
        $details['product'] = $this->productRepository->getProductDetails($product,$user_id);
        $details['related_products'] = $this->productRepository->getRelatedProduct($product->category_id,$product->subcategory_id,$user_id,$product_id);
        return $this->respond(
            200,
            trans('messages.products.page'),
            $details
            );
    }

    public function hotOffers($user_id = null){
        $hot_offers = HotOffersProduct::where('to_date','>=',Carbon::now()->toDateString())->get();
        $data = $this->productRepository->getHotOffersList($hot_offers,$user_id);
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
      );
    }

}
