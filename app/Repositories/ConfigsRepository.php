<?php

namespace App\Repositories;

use App\Models\Config;
use App\Repositories\SourceRepository;

class ConfigsRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Config::class;
    }
    public function getModel()
    {
        return new Config();
    }
}
