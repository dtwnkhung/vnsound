<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use App\Models\News;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class NewsController extends Controller
{
    public function __construct(NewsRepository $repository)
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
        return view('modules.news.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $items = $this->getListData();

        return Datatables::of($items)
            ->addColumn('title', function ($item) {
                return '<a href="'. route('news.view', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->title.'</a>';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('type', function ($item) {
                if($item->type == 1){
                    return '<span>Tin tức</span>';
                }else if($item->type == 2){
                    return '<span>Kiến thức</span>';
                }else if($item->type == 3){
                    return '<span>Tin nổi bật</span>';
                }else if($item->type == 4){
                    return '<span>Kiến thức nổi bật</span>';
                }else{
                    return '<span>Không xác định</span>';
                }
            })
            ->rawColumns(['title','type','created_at','updated_at'])
            ->make(true);
    }

    public function view($id)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"View"]
        ];
        $item = $this->getSingleData($id);
        return view('modules.news.view', ['breadcrumbs' => $breadcrumbs,'item' => $item]);
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
            ['link'=>"admin/news",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/news/')) {
            mkdir(public_path('images/news/'), 0777, true);
        }
        return view('modules.news.add', ['breadcrumbs' => $breadcrumbs]);
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
            'title'                  => 'required|max:255|unique:news,title',
            'sub_title'                  => 'required|max:255',
            'image'                 => 'required',
            'type'                 => 'required',
        ];
        $arrMess  = [
            'title.required'         => 'Vui lòng nhập tiêu đề!',
            'title.max'              => 'Tiêu đề có độ dài tối đa 255 kí tự!',
            'title.unique' 			=> 'Tiêu đề trùng với tên danh mục!',
            'sub_title.required'         => 'Vui lòng nhập mô tả ngắn!',
            'sub_title.max'              => 'Mô tả ngắn có độ dài tối đa 255 kí tự!',
            'image.required'       => 'Vui lòng chọn ảnh!',
            'type.required'       => 'Vui lòng loại tin tức!',
        ];
        $item = new News();

        $this->validate($request, $arrRules, $arrMess);
        $images = [];
        foreach($request->file('image') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
            while (file_exists(public_path('images/news/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/news/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/news/').$filename)->resize(370, 241);

            $img->save(public_path('images/news/').'600x400-'.$filename);
            $images[] = $filename;
        }
        $item->images = implode(',', $images);
        $item->title              = $request->title;
        $item->sub_title              = $request->sub_title;
        $item->slug              = Common::createAlias($request->title);
        $item->description        = $request->description;
        $item->type                 = $request->type;
        $item->save();
        return redirect('admin/news')->with('thongbao', 'Thêm mới tin tức thành công!');
    }

    public function handlerImage(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename =  Str::random(15).'.'.$extension;
        while (file_exists(public_path('/images/news/').$filename)) {
            $filename =  Str::random(15).'.'.$extension;
        }
        try{
            $file->move(public_path('images/news/'), $filename);
            return response()->json(['urlImg'=>'/images/news/'.$filename]);

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
            ['link'=>"admin/news",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->images = explode(',', $item->images);
        return view('modules.news.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
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
            'title'                  => 'required|max:255|unique:news,title,'.$id,
            'sub_title'                  => 'required|max:255',
            'type'                  => 'required|max:255',
        ];
        $arrMess  = [
            'title.required'         => 'Vui lòng nhập tiêu đề!',
            'title.max'              => 'Tiêu đề có độ dài tối đa 255 kí tự!',
            'title.unique' 			=> 'Tiêu đề trùng với tên danh mục!',
            'sub_title.required'         => 'Vui lòng nhập mô tả ngắn!',
            'sub_title.max'              => 'Mô tả ngắn có độ dài tối đa 255 kí tự!',
            'type.required'       => 'Vui lòng loại tin tức!',
        ];
        $item = $this->getSingleData($id);
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('image')){
            $images = [];
            foreach($request->file('image') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/news/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/news/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/news/').$filename)->resize(370, 241);

                $img->save(public_path('images/news/').'600x400-'.$filename);
                $images[] = $filename;
                $item->images = implode(',', $images);
            }

            $item->images = implode(',', $images);
        }
        $item->title              = $request->title;
        $item->sub_title              = $request->sub_title;
        $item->slug              = Common::createAlias($request->title);
        $item->description        = $request->description;
        $item->type                 = $request->type;
        $item->save();
        return redirect('admin/news')->with('thongbao', 'Cập nhật tin tức thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/news')->with('thongbao', 'Xóa sản phẩm thành công!');
    }
}
