<?php

namespace App\Repositories\Product;

use App\Exceptions\GeneralException;
use App\Models\Product\Product;
use App\Models\ProductImage\ProductImage;
use App\Models\UserFavorite\UserFavorite;
use App\Models\UserReview\UserReview;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;

/**
* Class NotificationRepository.
*/
class ProductRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;
    public $userFavorite;
    public $userReview;
    public $productImage;

    public function __construct(Product $model, UserFavorite $userFavorite, UserReview $userReview, ProductImage $productImage)
    {
        $this->model = $model;
        $this->userFavorite = $userFavorite;
        $this->userReview = $userReview;
        $this->productImage = $productImage;
    }

    public function getAllProductsDetail($products,$user_id = null)
    {
        $product_list = [];
        $product_item = [];
        foreach ($products as $product){
            $product_item['id'] = $product->id;
            $product_item['name'] = $product->name;
            $product_item['description'] = $product->description;
            $product_item['price'] = $product->price;
            $product_item['product_image'] = $product->product_image;
            $product_item['share_link'] = '#';
            $product_item['user_favorite'] = '0';
            $product_item['rate'] = $this->getProductRate($product->id);
            if($user_id){
                $product_item['user_favorite'] = $this->userFavorite
                    ->where('user_id',$user_id)
                    ->where('product_id',$product->id)
                    ->get()
                    ->count();
            }
            $product_list[] = $product_item;
        }
        return $this->paginate($product_list,5);

        return $product_list;
    }
  public function getProductDetails($product,$user_id = null)
    {
            $product_item = [];
            $product_item['id'] = $product->id;
            $product_item['name'] = $product->name;
            $product_item['description'] = $product->description;
            $product_item['price'] = $product->price;
            $product_item['product_images'] = $this->getProductImages($product->id,$product->product_image);
            $product_item['share_link'] = '#';
            $product_item['user_favorite'] = 0;
            $product_item['rate'] = $this->getProductRate($product->id);
            if($user_id){
                $product_item['user_favorite'] = $this->userFavorite
                    ->where('user_id',$user_id)
                    ->where('product_id',$product->id)
                    ->get()
                    ->count();
            }
        return $product_item;
    }

    public function getRelatedProduct($category_id,$subcategory_id = null, $user_id = null,$current_product_id = null)
    {
            $query = $this->model->where('category_id',$category_id);
            if($subcategory_id){
                $query->where('subcategory_id', $subcategory_id);
            }
            if($current_product_id){
                $query->where('id','!=',$current_product_id);
            }
            $products = $query->whereStatus(1)->get();
            return $this->getAllProductsDetail($products,$user_id);
    }

    public function getProductRate($product_id){
        return round($this->userReview->where('product_id',$product_id)->avg('rate_value'));
    }

     public function getProductImages($product_id,$product_image){
         $images = [];
         $images = $this->productImage->where('product_id',$product_id)->pluck('image_name')->toArray();
         array_push($images,$product_image);
         return $images;
    }

    /**
     * Gera a paginação dos itens de um array ou collection.
     *
     * @param array|Collection      $items
     * @param int   $perPage
     * @param int  $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}