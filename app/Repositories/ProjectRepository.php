<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\SourceRepository;

class ProjectRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }
    public function getModel()
    {
        return new Project();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $cats = Project::take($length)
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }

}
