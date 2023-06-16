<?php

namespace App\Http\Controllers;

use App\Repositories\AchievementRepository;
use Illuminate\Http\Request;
use App\Models\Achievement;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class AchievementsController extends Controller
{
    public function __construct(AchievementRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"Danh sách"]
        ];
        return view('modules.achievements.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $items = $this->getListData();
        return Datatables::of($items)
            ->addColumn('title', function ($item) {
                return '<a href="'. route('achievements.edit', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->title.'</a>';
            })
            ->addColumn('images', function ($item) {
                return '<img src="'.url("/images/achievements").'/'.$item->images.'" width="150px" />';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->rawColumns(['title','images','created_at','updated_at'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/achievements",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/achievements/')) {
            mkdir(public_path('images/achievements/'), 0777, true);
        }
        return view('modules.achievements.add', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrRules =  [
            'title'                  => 'required|max:255',
            'images'                 => 'required',
        ];
        $arrMess  = [
            'title.required'         => 'Trường dữ liệu không được để tróng!',
            'title.max'              => 'Trường dữ liệu tối đa 255 kí tự!',
            'images.required'       => 'Vui lòng chọn ảnh!',
        ];
        $item = new Achievement();

        $this->validate($request, $arrRules, $arrMess);
        $images = [];
        foreach($request->file('images') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
            while (file_exists(public_path('images/achievements/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/achievements/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/achievements/').$filename);

            $img->save(public_path('images/achievements/').'400x400-'.$filename);
            $images[] = $filename;
        }
        $item->images = implode(',', $images);
        $item->title              = $request->title;
        $item->save();
        return redirect('admin/achievements')->with('thongbao', 'Thêm mới thành công!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/achievements",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->images = explode(',', $item->images);
        return view('modules.achievements.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arrRules =  [
            'title'                  => 'required|max:255',
        ];
        $arrMess  = [
            'title.required'         => 'Vui lòng nhập tên nhà khóa học!',
            'title.max'              => 'Tên khóa học tối đa 255 kí tự!',
        ];
        $item = $this->getSingleData($id);
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('images')){
            $images = [];
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/achievements/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/achievements/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/achievements/').$filename);

                $img->save(public_path('images/achievements/').'400x400-'.$filename);
                $images[] = $filename;
            }

            $item->images = implode(',', $images);
        }
        $item->title              = $request->title;
        $item->save();
        return redirect('admin/achievements')->with('thongbao', 'Cập nhật thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/achievements')->with('thongbao', 'Xóa thành công!');
    }
}
