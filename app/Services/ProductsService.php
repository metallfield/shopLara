<?php


namespace App\Services;


use App\Product;
use App\Repositories\ProductRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsService
{


    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $productRepository;
    public function __construct()
    {
        $this->productRepository = app(ProductRepository::class);
    }


    public function getAllProducts(?User $user = null)
    {
        return $this->productRepository->getAllProducts($user);
    }

    public function getRecommendProducts(Product $product)
    {
        return $this->productRepository->getRecommendProducts($product);
    }
    public function createProduct($data)
    {

        $fields = $data->except('categories');
        $fields['user_id'] = $data['user_id'];
        unset($fields['image']);
        if ($data->has('image'))
        {
            $imageName = time().'.'.$data->get('image')->extension();
            $path =  'images/'.$imageName;
            $fields['image'] = $path;
        }
        $id = $this->productRepository->storeProduct($fields->toArray());
        if (!empty($id))
        {
            if (isset($imageName)) {
                $data->get('image')->move(storage_path() . '/app/public/images', $imageName);
            }
            $categories = $data->get('categories');
            if (isset($categories))
            {
                foreach ($categories as $category)
                {
                    $this->productRepository->attachCategory( $id,$category);
                }
            }
        }
    }

    public function updateProduct($data, Product $product)
    {
        $fields = $data->except('categories');
        unset($fields['image']);
        if ($data->has('image') && $data->get('image') !== null)
        {
            Storage::delete($product->image);
            $image = $data->get('imageName');
            $imageName = uniqid().'_'.$image;
            $path =  'images/'.$imageName;
            $fields['image'] = $path;
        }
        if ( $this->productRepository->updateProduct($fields->toArray(), $product) && isset($imageName))
        {
             $data->get('image')->move(storage_path() . '/app/public/images', $imageName);
         }
        $categories = $data->get('categories');
        if (isset($categories))
        {
            $product->categories()->detach();
            foreach ($categories as $category) {
                $this->productRepository->attachCategory( $product->id ,$category);
            }
        }
        return true;
    }

    public function CheckOwner(Product $product, User $user)
    {

        if ($user->id === $product->user_id && $product->user_id !== null)
        {
            return true;
        }
        else{
            return  false;
        }
    }
}
