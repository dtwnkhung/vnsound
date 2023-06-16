<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\SourceRepository;

class ServiceRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Service::class;
    }
    public function getModel()
    {
        return new Service();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $cats = Service::take($length)
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }

}
