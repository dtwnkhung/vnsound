<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use App\Models\Slider;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class ProjectController extends Controller
{
    public function __construct(ProjectRepository $repository)
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
        return view('modules.projects.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $items = $this->getListData();
        return Datatables::of($items)
            ->addColumn('name', function ($item) {
                return '<a href="'. route('projects.edit', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->name.'</a>';
            })
            ->addColumn('thumbnail', function ($item) {
                return '<img src="'.url("/images/projects").'/'.$item->thumbnail.'" width="150px" />';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->rawColumns(['name','thumbnail','created_at','updated_at'])
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
            ['link'=>"admin/projects",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/projects/')) {
            mkdir(public_path('images/projects/'), 0777, true);
        }
        return view('modules.projects.add', ['breadcrumbs' => $breadcrumbs]);
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
            'name'                 => 'required',
            'thumbnail'                 => 'required',
        ];
        $arrMess  = [
            'name.required'       => 'Trường dữ liệu không được để trống!',
            'thumbnail.required'       => 'Vui lòng chọn ảnh!',
        ];
        $item = new Project();

        $this->validate($request, $arrRules, $arrMess);
        $thumbnail = [];
        foreach($request->file('thumbnail') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  'thumbnail-'.Str::random(15).'.'.$extension;
            while (file_exists(public_path('image_mobile/projects/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/projects/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/projects/').$filename);

            $img->save(public_path('images/projects/').$filename);
            $thumbnail[] = $filename;
        }
        $item->thumbnail = implode(',', $thumbnail);
        $item->name              = $request->name;
        $item->description        = $request->description;
        $item->save();
        return redirect('admin/projects')->with('thongbao', 'Thêm mới sự kiện thành công!');
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
            ['link'=>"admin/projects",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->thumbnail = explode(',', $item->thumbnail);
        return view('modules.projects.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
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
            'name'                 => 'required',
        ];
        $arrMess  = [
            'name.required'       => 'Trường dữ liệu không được để trống!',
        ];
        $item = $this->getSingleData($id);
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('thumbnail')){
            $thumbnail = [];
            foreach($request->file('thumbnail') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  'thumbnail-'.Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/projects/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/projects/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/projects/').$filename);

                $img->save(public_path('images/projects/').$filename);
                $thumbnail[] = $filename;
            }

            $item->thumbnail = implode(',', $thumbnail);
        }
        $item->name              = $request->name;
        $item->description              = $request->description;
        $item->save();
        return redirect('admin/projects')->with('thongbao', 'Cập nhật sự kiện thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/projects')->with('thongbao', 'Xóa sự kiện thành công!');
    }
}
