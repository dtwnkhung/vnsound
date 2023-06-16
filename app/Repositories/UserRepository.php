<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\User;
use App\Repositories\SourceRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    public function getModel()
    {
        return new User();
    }
    public function getTeachers()
    {
        $cats = User::where('type', '=', 1)->orderBy('id', 'asc')->get();
        return $cats;
    }
    public function listTeacherspaginate($take)
    {
        $list = User::where('type', 1)->orderBy('id', 'asc')->paginate($take);
        return $list;
    }
    public function searchTeachers($text, $take)
    {
        $cats = User::where('type', '=', 1)->where('name', 'like', '%'.$text.'%')->orderBy('id', 'asc')->paginate($take);
        return $cats;
    }
    public function getStudents()
    {
        $cats = User::where('type', '=', 2)->orderBy('id', 'asc')->get();
        return $cats;
    }

}
