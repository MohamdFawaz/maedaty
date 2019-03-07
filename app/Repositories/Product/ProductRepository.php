<?php

namespace App\Repositories\Product;

use App\Exceptions\GeneralException;
use App\Models\Product\Product;
use App\Models\ProductImage\ProductImage;
use App\Models\UserFavorite\UserFavorite;
use App\Models\UserReview\UserReview;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

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

    public function getAllProductsDetailPaginate($products,$user_id = null)
    {
        $product_list = [];
        $product_item = [];
        foreach ($products as $product){
            $hot_offer = (double)0;
            if($product->hot_offer){
                $hot_offer = (double)$product->hot_offer->discounted_price;
            }
            $product_item['id'] = $product->id;
            $product_item['name'] = $product->translate()->name;
            $product_item['description'] = $product->translate()->description;
            $product_item['price'] = $product->price;
            $product_item['discounted_price'] = $hot_offer;
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
    }

    public function getAllProductsDetailPaginateOffers($products,$user_id = null)
    {
        $product_list = [];
        $product_item = [];
        foreach ($products as $product){

            $product_item['id'] = $product->product->id;
            $product_item['name'] = $product->product->translate()->name;
            $product_item['description'] = $product->product->translate()->description;
            $product_item['price'] = $product->product->price;
            $product_item['discounted_price'] = (double)$product->discounted_price;
            $product_item['product_image'] = $product->product->product_image;
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
    }

    public function getAllProductsDetail($products,$user_id = null)
    {
        $product_list = [];
        $product_item = [];
        foreach ($products as $product){
            $hot_offer = (double)0;
            if($product->hot_offer){
                $hot_offer = (double)$product->hot_offer->discounted_price;
            }
            $product_item['id'] = $product->id;
            $product_item['name'] = $product->translate()->name;
            $product_item['description'] = $product->translate()->description;
            $product_item['price'] = $product->price;
            $product_item['product_image'] = $product->product_image;
            $product_item['discounted_price'] = $hot_offer;
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
        return $product_list;
    }
  public function getProductDetails($product,$user_id = null)
    {
            $hot_offer = (double)0;
            if($product->hot_offer){
                $hot_offer = (double)$product->hot_offer->discounted_price;
            }
            $product_item = [];
            $product_item['id'] = $product->id;
            $product_item['name'] = $product->translate()->name;
            $product_item['description'] = $product->translate()->description;
            $product_item['price'] = $product->price;
            $product_item['discounted_price'] = $hot_offer;
            $product_item['product_image'] = $product->product_image;
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

    public function getHotOffersList($hot_offers,$user_id = null){
        $hot_offers_list = [];
        $hot_offers_item = [];
        foreach ($hot_offers as $hot_offer){
            $hot_offers_item['discounted_price'] = $hot_offer->discounted_price;
            $hot_offers_item['product'] = $this->getProductDetails($hot_offer->product,$user_id);
            $hot_offers_list[] = $hot_offers_item;
        }
        return $hot_offers_list;
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
    public function getRelatedProductPaginate($category_id,$subcategory_id = null, $user_id = null,$current_product_id = null)
    {
            $query = $this->model->where('category_id',$category_id);
            if($subcategory_id){
                $query->where('subcategory_id', $subcategory_id);
            }
            if($current_product_id){
                $query->where('id','!=',$current_product_id);
            }
            $products = $query->status()->get();
            return $this->getAllProductsDetailPaginate($products,$user_id);
    }

    public function getProductRate($product_id){
        $avg_rate = $this->userReview->where('product_id',$product_id)->avg('rate_value');
        $result = round($avg_rate, 1);
        return (string)$result;
    }
    public function getProductPrice($product_id){
        $price = $this->model->where('product_id',$product_id)->pluck('price')->first();
        return $price;
    }

     public function getProductImages($product_id,$product_image){
         $images = $this->productImage->where('product_id',$product_id)->pluck('image_name')->toArray();
         array_push($images,$product_image);
         $images = array_reverse($images);
         return $images;
    }


    public function getProductStock($product_id){
        $stock = $this->model->where('id',$product_id)->pluck('product_stock')->first();
        return $stock;
    }

    public function getProductById($product_id){
        $product = $this->model->whereId($product_id)->first();
        $product_details = $this->getProductDetails($product);
        return $product_details;
    }

    public function delete($input){
        if(Product::delete($input)){
            return true;
        }
        return false;
    }

    /**
     * Gera a paginação dos itens de um array ou collection.
     *
     * @param array|Collection      $items
     * @param int   $perPage
     * @param int  $page
     * @param array $options
     *
     * @return array
     */
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        return [
            'current_page' => $lap->currentPage(),
            'data' => $lap ->values(),
            'first_page_url' => $lap ->url(1),
            'from' => $lap->firstItem(),
            'last_page' => $lap->lastPage(),
            'last_page_url' => $lap->url($lap->lastPage()),
            'next_page_url' => $lap->nextPageUrl(),
            'per_page' => $lap->perPage(),
            'prev_page_url' => $lap->previousPageUrl(),
            'to' => $lap->lastItem(),
            'total' => $lap->total(),
        ];
    }
}