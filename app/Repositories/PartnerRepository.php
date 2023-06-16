<?php

namespace App\Repositories;

use App\Models\Partner;
use App\Repositories\SourceRepository;

class PartnerRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Partner::class;
    }
    public function getModel()
    {
        return new Partner();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $cats = Partner::take($length)
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }

}
