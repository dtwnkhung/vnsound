<?php

namespace App\Repositories;

use App\Source;
use Czim\Repository\BaseRepository;

class SourceRepository extends BaseRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {

    }
    public function getModel()
    {

    }
    //Get list
    public function getListquery($colum = 'id', $condition = '>', $value = 0, $take = PHP_INT_MAX)
    {
        return $this->getModel()->where($colum, $condition, $value)->take($take)->orderBY('updated_at', 'desc')->get();
    }

    public function getOpinion($take = PHP_INT_MAX)
    {
        return $this->getModel()->whereNotNull('opinion')->take($take)->orderBY('updated_at', 'desc')->get();
    }

    public function getRepresentative($take = PHP_INT_MAX)
    {
        return $this->getModel()->whereNotNull('comments')->take($take)->orderBY('updated_at', 'desc')->get();
    }
    //Get by id
    public function getById($id)
    {
        return $this->getModel()->find($id);
    }
    //Get by slug
    public function getBySlug($slug)
    {
        $product = $this->getModel()->where('slug', '=', $slug)->first();
        $product->images = explode(',', $product->images);
        return $product;
    }
}
