<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\SourceRepository;

class StudentRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Student::class;
    }
    public function getModel()
    {
        return new Student();
    }

    public function getListRepresentative($length = PHP_INT_MAX)
    {
        $cats = Student::take($length)
            ->whereNotNull('comments')
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }

    public function getListOpinionByClassId($class_id, $length = PHP_INT_MAX)
    {
        $cats = Student::take($length)
            ->whereNotNull('opinion')
            ->where('class_id', '=', $class_id)
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }

}
