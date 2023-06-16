<?php

namespace App\Repositories;

use App\Models\Achievement;
use App\Models\Slider;
use App\Repositories\SourceRepository;

class AchievementRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Achievement::class;
    }
    public function getModel()
    {
        return new Achievement();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $cats = Achievement::take($length)
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }
    public function getListGroup($length = PHP_INT_MAX)
    {
        $cats = Achievement::take($length)
            ->orderBy('id', 'desc')
            ->get();
        $result = [];
        $i = 0;
        $range = floor(count($cats)/5);
        foreach($cats as $key => $item){
            if($key%5 == 0){
                $i++;
            }
            if($range-1 == $i){
                break;
            }
            $result[$i][] = $item;
        }
        return $result;
    }

}
