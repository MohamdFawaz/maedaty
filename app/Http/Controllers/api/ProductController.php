<?php

namespace App\Http\Controllers\api;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Requests\Category\ListCategoryRequest;
use App\Repositories\Product\ProductRepository;
use mysql_xdevapi\Exception;
use Illuminate\Pagination;


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
        $data = $this->productRepository->getAllProductsDetail($products,$user_id);
        return $this->respond(
            200,
            trans('messages.products.list'),
            $data
            );
    }

    public function show($product_id, $user_id = null){
        $product = Product::find($product_id)->whereStatus(1)->first();
        $details['product'] = $this->productRepository->getProductDetails($product,$user_id);
        $details['related_products'] = $this->productRepository->getRelatedProduct($product->category_id,$product->subcategory_id,$user_id,$product_id);
        return $this->respond(
            200,
            trans('messages.products.page'),
            $details
            );
    }

    public function test(ListCategoryRequest $request){
        $allcategories = Category::get();
        $categories = $this->categoryRepository->getAllCategoryDetailsWSub($allcategories);
        $message  = $categories;
//        foreach ($allcategories as $category){
//            $message[] = $category;
//        }
        return $this->respond(
            trans('status.success'),
            trans('messages.category.list'),
            $message
            );
    }
}
