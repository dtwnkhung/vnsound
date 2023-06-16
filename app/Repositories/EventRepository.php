<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Event;
use App\Repositories\SourceRepository;

class EventRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Event::class;
    }
    public function getModel()
    {
        return new Event();
    }
    public function getList($length = PHP_INT_MAX)
    {
        $cats = Event::take($length)
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get()
            ->unique('order');
        return $cats;
    }
    public function getListGroupSix($group = 1)
    {
        $start = ($group-1)*6;
        $items = Event::where('order', '>', $start)
            ->take(6)
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get()
            ->unique('order');
        $retval = [];
        foreach ($items as $key => $com){
            $retval[$com['order']] = $com;
        }
        return $retval;
    }

    public function getListGroup($length = PHP_INT_MAX)
    {
        $coms = Event::take($length)
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

    public function getDetailById($id, $length = PHP_INT_MAX)
    {
        $data = $this->getModel()
            ->where('id', '=', $id)
            ->take($length)->get();
        return $data;
    }
}
