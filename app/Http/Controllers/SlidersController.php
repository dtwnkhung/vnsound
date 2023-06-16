<?php

namespace App\Http\Controllers;

use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use App\Models\Slider;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class SlidersController extends Controller
{
    public function __construct(SliderRepository $repository)
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
        return view('modules.sliders.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $items = $this->getListData();
        return Datatables::of($items)
            ->addColumn('title', function ($item) {
                return '<a href="'. route('sliders.edit', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->title.'</a>';
            })
            ->addColumn('images', function ($item) {
                return '<img src="'.url("/images/slider_key").'/'.$item->images_key.'" width="150px" />';
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
            ['link'=>"admin/sliders",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/sliders/')) {
            mkdir(public_path('images/sliders/'), 0777, true);
        }
        return view('modules.sliders.add', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $arrRules =  [
    //         'title'                  => 'required|max:255',
    //         'images'                 => 'required',
    //     ];
    //     $arrMess  = [
    //         'title.required'         => 'Trường dữ liệu không được để tróng!',
    //         'title.max'              => 'Trường dữ liệu tối đa 255 kí tự!',
    //         'images.required'       => 'Vui lòng chọn ảnh!',
    //     ];
    //     $item = new slider();

    //     $this->validate($request, $arrRules, $arrMess);
    //     $images = [];
    //     foreach($request->file('images') as $file)
    //     {
    //         $extension = $file->getClientOriginalExtension();

    //         $filename =  Str::random(15).'.'.$extension;
    //         while (file_exists(public_path('images/sliders/').$filename)) {
    //             $filename =  Str::random(15).'.'.$extension;
    //         }
    //         try{
    //             $file->move(public_path('images/sliders/'), $filename);

    //         }catch (\Exception $e){
    //             echo "<pre>";
    //             print_r($e->getMessage());
    //             echo "</pre>";
    //             die();
    //         }
    //         $img = Image::make(public_path('images/sliders/').$filename);

    //         $img->save(public_path('images/sliders/').'1600x400-'.$filename);
    //         $images[] = $filename;
    //     }
    //     $item->images = implode(',', $images);
    //     $item->title              = $request->title;
    //     $item->type              = $request->type;
    //     $item->save();
    //     return redirect('admin/sliders')->with('thongbao', 'Thêm mới thành công!');
    // }

    public function store(Request $request)
    {
        $arrRules =  [
            'title'                  => 'required|max:255',
            'images'                 => 'required',
            'images_key'                 => 'required',
        ];
        $arrMess  = [
            'title.required'         => 'Trường dữ liệu không được để tróng!',
            'title.max'              => 'Trường dữ liệu tối đa 255 kí tự!',
            'images.required'       => 'Vui lòng chọn hình ảnh khác!',
            'images_key.required'       => 'Vui lòng chọn ảnh đại diện album!',
        ];
        $item = new slider();

        $this->validate($request, $arrRules, $arrMess);
        $images = [];
        $images_key = [];
        foreach($request->file('images') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
            while (file_exists(public_path('images/sliders/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/sliders/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/sliders/').$filename);

            $img->save(public_path('images/sliders/').'1600x400-'.$filename);
            $images[] = $filename;
        }

        foreach($request->file('images_key') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
            while (file_exists(public_path('images/slider_key/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/slider_key/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/slider_key/').$filename);

            $img->save(public_path('images/slider_key/').'1600x400-'.$filename);
            $images_key[] = $filename;
        }
        $item->images = implode(',', $images);
        $item->images_key = implode(',', $images_key);
        $item->title              = $request->title;
        // $item->type              = $request->type;
        $item->save();
        return redirect('admin/sliders')->with('thongbao', 'Thêm mới thành công!');
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
            ['link'=>"admin/sliders",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        // dd($item);
        $item->images = explode(',', $item->images);
        $item->images_key = explode(',', $item->images_key);
        return view('modules.sliders.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
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
        $item = $this->getSingleData($id);
        if($request->has('images') && $request->has('images_key')) {
            $arrRules =  [
                'title'                  => 'required|max:255',
                'images'                 => 'required',
                'images_key'                 => 'required',
            ];
            $arrMess  = [
                'title.required'         => 'Trường dữ liệu không được để tróng!',
                'title.max'              => 'Trường dữ liệu tối đa 255 kí tự!',
                'images.required'       => 'Vui lòng chọn hình ảnh khác!',
                'images_key.required'       => 'Vui lòng chọn ảnh đại diện album!',
            ];
        } else if ($request->has('images') && !$request->has('images_key')) {
            $arrRules =  [
                'title'                  => 'required|max:255',
                'images'                 => 'required',
            ];
            $arrMess  = [
                'title.required'         => 'Trường dữ liệu không được để tróng!',
                'title.max'              => 'Trường dữ liệu tối đa 255 kí tự!',
                'images.required'       => 'Vui lòng chọn hình ảnh khác!',
            ];
        } else if (!$request->has('images') && $request->has('images_key')) {
            $arrRules =  [
                'title'                  => 'required|max:255',
                'images_key'                 => 'required',
            ];
            $arrMess  = [
                'title.required'         => 'Trường dữ liệu không được để tróng!',
                'title.max'              => 'Trường dữ liệu tối đa 255 kí tự!',
                'images_key.required'       => 'Vui lòng chọn ảnh đại diện album!',
            ];
        } else {
            $arrRules =  [
                'title'                  => 'required|max:255',
            ];
            $arrMess  = [
                'title.required'         => 'Trường dữ liệu không được để tróng!',
                'title.max'              => 'Trường dữ liệu tối đa 255 kí tự!',
            ];
        }
            
        // $arrRules =  [
        //     'title'                  => 'required|max:255',
        // ];
        // $arrMess  = [
        //     'title.required'         => 'Vui lòng nhập tên nhà khóa học!',
        //     'title.max'              => 'Tên khóa học tối đa 255 kí tự!',
        // ];
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('images')){
            $images = [];
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/sliders/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/sliders/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/sliders/').$filename);

                $img->save(public_path('images/sliders/').'1600x400-'.$filename);
                $images[] = $filename;
            }

            $item->images = implode(',', $images);
        }

        if($request->has('images_key')){
            $images_key = [];
            foreach($request->file('images_key') as $file)
            {
                $extension = $file->getClientOriginalExtension();
    
                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/slider_key/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/slider_key/'), $filename);
    
                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/slider_key/').$filename);
    
                $img->save(public_path('images/slider_key/').'1600x400-'.$filename);
                $images_key[] = $filename;
            }
        }
        if($request->has('images')){ 
            $item->images = implode(',', $images);
        }
        if($request->has('images_key')){ 
            $item->images_key = implode(',', $images_key);
        }
        
        $item->title              = $request->title;
        // $item->type              = $request->type;
        $item->save();
        return redirect('admin/sliders')->with('thongbao', 'Cập nhật thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/sliders')->with('thongbao', 'Xóa thành công!');
    }
}
