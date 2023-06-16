<?php

namespace App\Repositories;

use App\Models\Component;
use App\Repositories\SourceRepository;

class ComponentRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Component::class;
    }
    public function getModel()
    {
        return new Component();
    }
    //Get by slug
    public function getBySlug($slug)
    {
        $product = $this->getModel()->where('slug', '=', $slug)->first();
        return $product;
    }
    //Get by slug
    public function getListParner($slug)
    {
        $product = $this->getModel()->where('slug', 'like', $slug.'%')->get();
        return $product;
    }
}
