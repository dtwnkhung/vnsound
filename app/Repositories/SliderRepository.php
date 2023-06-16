<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Slider;
use App\Repositories\SourceRepository;

class SliderRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Slider::class;
    }
    public function getModel()
    {
        return new Slider();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $cats = Slider::take($length)
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }
    
    public function getListByType($type, $length = PHP_INT_MAX)
    {
        
        $list = $this->getModel()
            ->where('type', '=', $type)
            ->take($length)->orderBY('id', 'desc')->get();
        return $list;
    }
    
    public function getListById($id, $length = PHP_INT_MAX)
    {
        
        $list = $this->getModel()
            ->where('id', '=', $id)
            ->take($length)->orderBY('id', 'desc')->get();
        return $list;
    }

    public function getOneByType($type, $length = 1)
    {
        $list = $this->getModel()
            ->where('type', '=', $type)
            ->take($length)->orderBY('id', 'desc')->get();
        return $list;
    }

    public function getListGroup($length = PHP_INT_MAX)
    {
        $coms = Slider::take($length)
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get()
            ->unique('order');
        $retval = [];
        $i = 0;
        foreach ($coms as $key => $com){
            $order = $com->order%6;
            if($order == 0){
                $order = 6;
            }
            $retval[$i][$order] = $com;
            if(($key+1)%6 == 0){
                $i++;
            }
        }
        return $retval;
    }
}
