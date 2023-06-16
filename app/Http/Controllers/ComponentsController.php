<?php

namespace App\Http\Controllers;

use App\Repositories\ComponentRepository;
use Illuminate\Http\Request;
use App\Models\Component;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;


class ComponentsController extends Controller
{
    public function __construct(ComponentRepository $repository)
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
        return view('modules.components.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $items = $this->getListData();
        return Datatables::of($items)
            ->addColumn('title', function ($item) {
                return '<a href="'. route('components.edit', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->title.'</a>';
            })
            ->addColumn('image', function ($item) {
                if($item->image){
                    return '<img src="'.url("/images/components").'/'.$item->image.'" width="100%" />';
                }
                return '';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->rawColumns(['title','image','created_at','updated_at'])
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
            ['link'=>"admin/components",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/components/')) {
            mkdir(public_path('images/components/'), 0777, true);
        }
        return view('modules.components.add', ['breadcrumbs' => $breadcrumbs]);
    }

    public function handlerImage(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename =  Str::random(15).'.'.$extension;
        while (file_exists(public_path('/images/components/').$filename)) {
            $filename =  Str::random(15).'.'.$extension;
        }
        try{
            $file->move(public_path('images/components/'), $filename);
            return response()->json(['urlImg'=>'/images/components/'.$filename]);

        }catch (\Exception $e){
            echo "<pre>";
            print_r($e->getMessage());
            echo "</pre>";
            die();
        }
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
            'slug'                  => 'required|max:255|unique:components,slug',
        ];
        $arrMess  = [
            'title.required'         => 'Vui lòng nhập title!',
            'title.max'              => 'Title có độ dài tối đa 255 kí tự!',
            'slug.required'         => 'Vui lòng nhập slug!',
            'slug.max'              => 'Slug có độ dài tối đa 255 kí tự!',
            'slug.unique'              => 'Slug đã tồn tại!',
        ];
        $item = new Component();

        $request->slug              = Common::createAlias($request->slug);
        $this->validate($request, $arrRules, $arrMess);
        $images = [];
        $request_img = $request->file('image')? $request->file('image') : [];
        foreach($request_img  as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
            while (file_exists(public_path('images/components/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/components/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/components/').$filename);

            $img->save(public_path('images/components/').'1600x400-'.$filename);
            $images[] = $filename;
        }
        $request_file = $request->file('files')? $request->file('files') : [];
        if($request_file){

            $filename = $request_file->getclientoriginalname();
            $path = public_path('images/components/files');
            $request_file->move($path, $filename);
            $item->files = $filename;
        }
        $item->images = implode(',', $images);
        $item->title              = $request->title;
        $item->slug              = Common::createAlias($request->slug);
        $item->link        = $request->link;
        $item->description        = $request->description;
        $item->save();
        return redirect('admin/components')->with('thongbao', 'Thêm mới thành phần thành công!');
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
            ['link'=>"admin/components",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->images = $item->files ? explode(',', $item->images) : [];
        $item->files = $item->files ? explode(',', $item->files) : [];
        return view('modules.components.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
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
            'title.required'         => 'Vui lòng nhập title!',
            'title.max'              => 'Title có độ dài tối đa 255 kí tự!',
        ];
        $item = $this->getSingleData($id);
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('image')){
            $images = [];
            foreach($request->file('image') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/components/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/components/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/components/').$filename);

                $img->save(public_path('images/components/').'1600x400-'.$filename);
                $images[] = $filename;
            }

            $item->images = implode(',', $images);
        }
        $request_file = $request->file('files')? $request->file('files') : [];
        if($request_file){

            $filename = $request_file->getclientoriginalname();
            $path = public_path('images/components/files');
            $request_file->move($path, $filename);
            $item->files = $filename;
        }
        $item->title              = $request->title;
        $item->link        = $request->link;
        $item->description        = $request->description;
        $item->save();
        return redirect('admin/components')->with('thongbao', 'Cập nhật thành phần thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/components')->with('thongbao', 'Xóa thành phần thành công!');
    }
}
