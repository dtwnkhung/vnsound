<?php

namespace App\Repositories;

use App\Models\OtherNews;
use App\Repositories\SourceRepository;

class OtherNewsRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return OtherNews::class;
    }
    public function getModel()
    {
        return new OtherNews();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $cats = OtherNews::take($length)
            ->orderBy('id', 'asc')
            ->get();
        return $cats;
    }
}
