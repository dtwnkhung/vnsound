<?php

namespace App\Repositories;

use App\Models\Artist;
use App\Repositories\SourceRepository;

class ArtistRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Artist::class;
    }
    public function getModel()
    {
        return new Artist();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $items = Artist::take($length)->orderBy('id', 'asc')->get();
        return $items;
    }
    
    public function getPagination($take = PHP_INT_MAX)
    {
        $list = Artist::paginate($take);
        return $list;
    }
}
