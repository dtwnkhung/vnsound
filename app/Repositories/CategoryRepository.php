<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Czim\Repository\BaseRepository;

class CategoryRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    public function getModel()
    {
        return new Category();
    }
    public function getListAndProduct($length = PHP_INT_MAX)
    {
        $cats = Category::take($length)->orderBy('id', 'asc')->get();
        return $cats;
    }
    public function getCateAndProduct($id)
    {
        $cats = Category::find($id);
        $products = $cats->products;
        foreach ($products as $key => $pro){
            $listImg = explode(',', $pro->images);
            if($listImg[0] != ''){
                $products[$key]['avatar'] = $listImg[0];
            }else{
                $products[$key]['avatar'] = 'product.jpg';
            }
        }
        $cats['products'] = $products;
        return $cats;
    }

}
