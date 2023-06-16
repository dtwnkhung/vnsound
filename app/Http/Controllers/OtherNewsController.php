<?php

namespace App\Http\Controllers;

use App\Repositories\OtherNewsRepository;
use Illuminate\Http\Request;
use App\Models\OtherNews;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class OtherNewsController extends Controller
{
    public function __construct(OtherNewsRepository $repository)
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
        return view('modules.otherNews.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $items = $this->getListData();

        return Datatables::of($items)
            ->addColumn('title', function ($item) {
                return '<a href="'. route('otherNews.edit', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->title.'</a>';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->rawColumns(['title','created_at','updated_at'])
            ->make(true);
    }

    public function view($id)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"View"]
        ];
        $item = $this->getSingleData($id);
        return view('modules.otherNews.view', ['breadcrumbs' => $breadcrumbs,'item' => $item]);
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
            ['link'=>"admin/otherNews",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/otherNews/')) {
            mkdir(public_path('images/otherNews/'), 0777, true);
        }
        return view('modules.otherNews.add', ['breadcrumbs' => $breadcrumbs]);
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
            'image'                 => 'required',
        ];
        $arrMess  = [
            'title.required'         => 'Vui lòng nhập tiêu đề!',
            'title.max'              => 'Tiêu đề có độ dài tối đa 255 kí tự!',
            'title.unique' 			=> 'Tiêu đề trùng với tên danh mục!',
            'image.required'       => 'Vui lòng chọn ảnh!',
        ];
        $item = new OtherNews();

        $this->validate($request, $arrRules, $arrMess);
        $images = [];
        foreach($request->file('image') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
            while (file_exists(public_path('images/otherNews/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/otherNews/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/otherNews/').$filename)->resize(370, 220);

            $img->save(public_path('images/otherNews/').'600x400-'.$filename);
            $images[] = $filename;
        }
        $item->images = implode(',', $images);
        $item->title              = $request->title;
        $item->link        = $request->link;
        $item->save();
        return redirect('admin/otherNews')->with('thongbao', 'Thêm mới tin tức thành công!');
    }

    public function handlerImage(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename =  Str::random(15).'.'.$extension;
        while (file_exists(public_path('/images/otherNews/').$filename)) {
            $filename =  Str::random(15).'.'.$extension;
        }
        try{
            $file->move(public_path('images/otherNews/'), $filename);
            return response()->json(['urlImg'=>'/images/otherNews/'.$filename]);

        }catch (\Exception $e){
            echo "<pre>";
            print_r($e->getMessage());
            echo "</pre>";
            die();
        }
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
            ['link'=>"admin/otherNews",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->images = explode(',', $item->images);
        return view('modules.otherNews.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
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
            'title.required'         => 'Vui lòng nhập tiêu đề!',
            'title.max'              => 'Tiêu đề có độ dài tối đa 255 kí tự!',
            'title.unique' 			=> 'Tiêu đề trùng với tên danh mục!',
        ];
        $item = $this->getSingleData($id);
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('image')){
            $images = [];
            foreach($request->file('image') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/otherNews/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/otherNews/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/otherNews/').$filename)->resize(370, 220);

                $img->save(public_path('images/otherNews/').'600x400-'.$filename);
                $images[] = $filename;
                $item->images = implode(',', $images);
            }

            $item->images = implode(',', $images);
        }
        $item->title              = $request->title;
        $item->link        = $request->link;
        $item->save();
        return redirect('admin/otherNews')->with('thongbao', 'Cập nhật tin tức thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/otherNews')->with('thongbao', 'Xóa sản phẩm thành công!');
    }
}
