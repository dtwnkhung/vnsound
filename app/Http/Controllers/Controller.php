<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Repositories\SourceRepository;
use Yajra\DataTables\DataTables;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repository;

    public function getListData()
    {
        $products = $this->repository->getListquery();

        return $products;
    }

    public function getDataOpinion()
    {
        $products = $this->repository->getOpinion();

        return $products;
    }

    public function getDataRepresentative()
    {
        $products = $this->repository->getRepresentative();

        return $products;
    }

    public function getSingleData($id)
    {
        $products = $this->repository->getById($id);

        return $products;
    }
}
