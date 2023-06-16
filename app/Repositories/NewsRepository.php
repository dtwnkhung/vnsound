<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\OtherNews;
use App\Repositories\SourceRepository;
use Illuminate\Support\Facades\DB;

class NewsRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }
    public function getModel()
    {
        return new News();
    }
    //Get list
    public function getListTinTuc($take = PHP_INT_MAX)
    {
        $list = $this->getListquery('type', '=', 1, $take);
        foreach($list as $key => $news){
            $day = date('d', strtotime($news['created_at']));
            $month = date('m', strtotime($news['created_at']));
            $year = date('Y', strtotime($news['created_at']));
            $news['ngay_tao'] = $day.' Tháng '.$month.', '.$year;
            $dayU = date('d', strtotime($news['updated_at']));
            $monthU = date('m', strtotime($news['updated_at']));
            $yearU = date('Y', strtotime($news['updated_at']));
            $news['ngay_sua'] = $dayU.' Tháng '.$monthU.', '.$yearU;
            $list[$key] = $news;

        }
        return $list;
    }
    //Get list
    public function getListKienThuc($take = PHP_INT_MAX)
    {
        $list = $this->getListquery('type', '=', 2, $take);
        foreach($list as $key => $news){
            $day = date('d', strtotime($news['created_at']));
            $month = date('m', strtotime($news['created_at']));
            $year = date('Y', strtotime($news['created_at']));
            $news['ngay_tao'] = $day.' Tháng '.$month.', '.$year;
            $dayU = date('d', strtotime($news['updated_at']));
            $monthU = date('m', strtotime($news['updated_at']));
            $yearU = date('Y', strtotime($news['updated_at']));
            $news['ngay_sua'] = $dayU.' Tháng '.$monthU.', '.$yearU;
            $list[$key] = $news;

        }
        return $list;
    }
    public function getListTinTucLienQuan($id, $take = PHP_INT_MAX)
    {
        $list = $this->getModel()
            ->where('type', '=', 1)
            ->where('id', '<>', $id)
            ->take($take)->orderBY('updated_at', 'desc')->get();
        foreach($list as $key => $news){
            $day = date('d', strtotime($news['created_at']));
            $month = date('m', strtotime($news['created_at']));
            $year = date('Y', strtotime($news['created_at']));
            $news['ngay_tao'] = $day.' Tháng '.$month.', '.$year;
            $dayU = date('d', strtotime($news['updated_at']));
            $monthU = date('m', strtotime($news['updated_at']));
            $yearU = date('Y', strtotime($news['updated_at']));
            $news['ngay_sua'] = $dayU.' Tháng '.$monthU.', '.$yearU;
            $list[$key] = $news;

        }
        return $list;
    }

    public function getListTinTucPagination($take = PHP_INT_MAX)
    {
        $list = News::where('type', '=', 1)
            ->paginate($take);
        foreach($list as $key => $news){
            $day = date('d', strtotime($news->created_at));
            $month = date('m', strtotime($news->created_at));
            $year = date('Y', strtotime($news->created_at));
            $news->ngay_tao = $day.' Tháng '.$month.', '.$year;
            $dayU = date('d', strtotime($news->updated_at));
            $monthU = date('m', strtotime($news->updated_at));
            $yearU = date('Y', strtotime($news->updated_at));
            $news->ngay_sua = $dayU.' Tháng '.$monthU.', '.$yearU;
            $list[$key] = $news;

        }
        return $list;
    }

    
    public function getKnowledgesPagination($take = PHP_INT_MAX)
    {
        $list = News::where('type', '=', 2)
            ->paginate($take);
        foreach($list as $key => $news){
            $day = date('d', strtotime($news->created_at));
            $month = date('m', strtotime($news->created_at));
            $year = date('Y', strtotime($news->created_at));
            $news->ngay_tao = $day.' Tháng '.$month.', '.$year;
            $dayU = date('d', strtotime($news->updated_at));
            $monthU = date('m', strtotime($news->updated_at));
            $yearU = date('Y', strtotime($news->updated_at));
            $news->ngay_sua = $dayU.' Tháng '.$monthU.', '.$yearU;
            $list[$key] = $news;

        }
        return $list;
    }
    //Get list
    public function getTinnoibat($take = PHP_INT_MAX)
    {
        $list = $this->getListquery('type', '=', 3, $take);
        foreach($list as $key => $news){
            $day = date('d', strtotime($news['created_at']));
            $month = date('m', strtotime($news['created_at']));
            $year = date('Y', strtotime($news['created_at']));
            $news['ngay_tao'] = $day.' Tháng '.$month.', '.$year;
            $dayU = date('d', strtotime($news['updated_at']));
            $monthU = date('m', strtotime($news['updated_at']));
            $yearU = date('Y', strtotime($news['updated_at']));
            $news['ngay_sua'] = $dayU.' Tháng '.$monthU.', '.$yearU;
            $list[$key] = $news;

        }
        return $list;
    }

    
    //Get list
    public function getHotKnowledge($take = PHP_INT_MAX)
    {
        $list = $this->getListquery('type', '=', 4, $take);
        foreach($list as $key => $news){
            $day = date('d', strtotime($news['created_at']));
            $month = date('m', strtotime($news['created_at']));
            $year = date('Y', strtotime($news['created_at']));
            $news['ngay_tao'] = $day.' Tháng '.$month.', '.$year;
            $dayU = date('d', strtotime($news['updated_at']));
            $monthU = date('m', strtotime($news['updated_at']));
            $yearU = date('Y', strtotime($news['updated_at']));
            $news['ngay_sua'] = $dayU.' Tháng '.$monthU.', '.$yearU;
            $list[$key] = $news;

        }
        return $list;
    }
}
