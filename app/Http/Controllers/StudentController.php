<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use App\Models\Slider;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;
use App\Repositories\ProductRepository;

class StudentController extends Controller
{
    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function representativeStudent()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"Danh sách"]
        ];
        return view('modules.students.indexRepresentative', ['breadcrumbs' => $breadcrumbs]);
    }

    public function opinionStudent()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"Danh sách"]
        ];
        return view('modules.students.indexOpinion', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getListOpinion()
    {
        $items = $this->getDataOpinion();
        return Datatables::of($items)
            ->addColumn('name', function ($item) {
                return '<a href="'. route('students.editOpinionStudent', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->name.'</a>';
            })
            ->addColumn('class_id', function ($item) {
                return $item->getclass->name;
            })
            ->addColumn('thumbnail', function ($item) {
                return '<img src="'.url("/images/students").'/'.$item->thumbnail.'" width="150px" />';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->rawColumns(['name','class_id','thumbnail','created_at','updated_at'])
            ->make(true);
    }

    public function getListRepresentative()
    {
        $items = $this->getDataRepresentative();
        return Datatables::of($items)
            ->addColumn('name', function ($item) {
                return '<a href="'. route('students.editOpinionStudent', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->name.'</a>';
            })
            ->addColumn('class_id', function ($item) {
                return $item->getclass->name;
            })
            ->addColumn('thumbnail', function ($item) {
                return '<img src="'.url("/images/students").'/'.$item->thumbnail.'" width="150px" />';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->rawColumns(['name','class_id','thumbnail','created_at','updated_at'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRepresentative(ProductRepository $productRepository)
    {
        $prodcuts = $productRepository->getListProduct();
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/students",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/students/')) {
            mkdir(public_path('images/students/'), 0777, true);
        }
        return view('modules.students.addRepresentative', [
            'breadcrumbs' => $breadcrumbs,
            'prodcuts' => $prodcuts
        ]);
    }

    public function createOpinion(ProductRepository $productRepository)
    {
        $prodcuts = $productRepository->getListProduct();
        $items = $this->getListData();
        // var_dump($item);exit();
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/students/opinionStudent",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/students/')) {
            mkdir(public_path('images/students/'), 0777, true);
        }
        return view('modules.students.addOpinion', [
            'breadcrumbs' => $breadcrumbs,
            'prodcuts' => $prodcuts,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRepresentative(Request $request)
    {
        $arrRules =  [
            'name'                 => 'required',
            'thumbnail'                 => 'required',
            'class_id'                 => 'required',
        ];
        $arrMess  = [
            'name.required'       => 'Trường dữ liệu không được để trống!',
            'thumbnail.required'       => 'Vui lòng chọn ảnh!',
            'thumbnail.class_id'       => 'Vui lòng chọn lớp học!',
        ];
        $item = new Student();

        $this->validate($request, $arrRules, $arrMess);
        $thumbnail = [];
        foreach($request->file('thumbnail') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  'thumbnail-'.Str::random(15).'.'.$extension;
            while (file_exists(public_path('image_mobile/students/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/students/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/students/').$filename);

            $img->save(public_path('images/students/').$filename);
            $thumbnail[] = $filename;
        }
        $item->thumbnail = implode(',', $thumbnail);
        $item->name              = $request->name;
        $item->class_id              = $request->class_id;
        $item->comments        = $request->comments;
        $item->save();
        return redirect('admin/students/representativeStudent')->with('thongbao', 'Thêm mới sự kiện thành công!');
    }

    public function storeOpinion(Request $request)
    {
        $arrRules =  [
            'name'                 => 'required',
            'thumbnail'                 => 'required',
            'opinion'                 => 'required',
            'class_id'                 => 'required',
        ];
        $arrMess  = [
            'name.required'       => 'Trường dữ liệu không được để trống!',
            'thumbnail.required'       => 'Vui lòng chọn ảnh!',
            'opinion.required'       => 'Vui lòng nhập ý kiến học viên!',
            'class_id.required'       => 'Vui lòng chọn lớp học!',

        ];
        $item = new Student();

        $this->validate($request, $arrRules, $arrMess);
        $thumbnail = [];
        foreach($request->file('thumbnail') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  'thumbnail-'.Str::random(15).'.'.$extension;
            while (file_exists(public_path('image_mobile/students/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/students/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/students/').$filename);

            $img->save(public_path('images/students/').$filename);
            $thumbnail[] = $filename;
        }
        $item->thumbnail = implode(',', $thumbnail);
        $item->name              = $request->name;
        $item->class_id              = $request->class_id;
        $item->opinion        = $request->opinion;
        $item->save();
        return redirect('admin/students/opinionStudent')->with('thongbao', 'Thêm mới ý kiến thành công!');

        // $arrRules =  [
        //     'id_student'                 => 'required',
        //     'opinion'                 => 'required',
        // ];
        // $arrMess  = [
        //     'id_student.required'       => 'Vui lòng chọn học viên!',
        //     'opinion.required'       => 'Vui lòng điền ý kiến học viên!',
        //     // 'thumbnail.class_id'       => 'Vui lòng chọn lớp học!',
        // ];
        // // $item = new Student();
        // $item = $this->getSingleData($request->id_student);
        // $this->validate($request, $arrRules, $arrMess);
      
        // // $item->id_student              = $request->id_student;
        // $item->opinion              = $request->opinion;
        // // $item->comments        = $request->comments;
        // $item->save();
        // return redirect('admin/students/opinionStudent')->with('thongbao', 'Thêm mới ý kiến thành công!');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRepresentativeStudent($id, ProductRepository $productRepository)
    {
        $prodcuts = $productRepository->getListProduct();
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/students",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->thumbnail = explode(',', $item->thumbnail);
        return view('modules.students.editRepresentative', [
            'breadcrumbs' => $breadcrumbs, 
            'item' => $item,
            'prodcuts' => $prodcuts
        ]);
    }

    public function editOpinionStudent($id, ProductRepository $productRepository)
    {
        $prodcuts = $productRepository->getListProduct();
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/students/opinionStudent",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->thumbnail = explode(',', $item->thumbnail);
        return view('modules.students.editOpinion', [
            'breadcrumbs' => $breadcrumbs, 
            'item' => $item,
            'prodcuts' => $prodcuts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOpinionStudent(Request $request, $id) 
    {
        $item = $this->getSingleData($id);
        if(!empty($item->thumbnail)) {
            $arrRules =  [
                'name'                 => 'required',
                'opinion'                 => 'required',
                'class_id'                 => 'required',
            ];
            $arrMess  = [
                'name.required'       => 'Trường dữ liệu không được để trống!',
                'opinion.required'       => 'Vui lòng nhập ý kiến học viên!',
                'class_id.required'       => 'Vui lòng chọn lớp học!',
    
            ];
        } else {
            $arrRules =  [
                'name'                 => 'required',
                'thumbnail'                 => 'required',
                'opinion'                 => 'required',
                'class_id'                 => 'required',
            ];
            $arrMess  = [
                'name.required'       => 'Trường dữ liệu không được để trống!',
                'thumbnail.required'       => 'Vui lòng chọn ảnh!',
                'opinion.required'       => 'Vui lòng nhập ý kiến học viên!',
                'class_id.required'       => 'Vui lòng chọn lớp học!',
    
            ];
        }
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('thumbnail')){
            $thumbnail = [];
            foreach($request->file('thumbnail') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  'thumbnail-'.Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/students/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/students/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/students/').$filename);

                $img->save(public_path('images/students/').$filename);
                $thumbnail[] = $filename;
            }

            $item->thumbnail = implode(',', $thumbnail);
        }
        $item->name              = $request->name;
        $item->opinion              = $request->opinion;
        $item->class_id              = $request->class_id;
        $item->save();
        return redirect('admin/students/opinionStudent')->with('thongbao', 'Cập nhật ý kiện học viên thành công!');
    }

    public function updateRepresentativeStudent(Request $request, $id)
    {
        $arrRules =  [
            'name'                 => 'required',
            'class_id'                 => 'required',
        ];
        $arrMess  = [
            'name.required'       => 'Trường dữ liệu không được để trống!',
            'thumbnail.class_id'       => 'Vui lòng chọn lớp học!',
        ];
        $item = $this->getSingleData($id);
        $this->validate($request, $arrRules, $arrMess);
        if($request->has('thumbnail')){
            $thumbnail = [];
            foreach($request->file('thumbnail') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  'thumbnail-'.Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/students/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/students/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/students/').$filename);

                $img->save(public_path('images/students/').$filename);
                $thumbnail[] = $filename;
            }

            $item->thumbnail = implode(',', $thumbnail);
        }
        $item->name              = $request->name;
        $item->comments              = $request->comments;
        $item->class_id              = $request->class_id;
        $item->save();
        return redirect('admin/students/representativeStudent')->with('thongbao', 'Cập nhật học viên thành công!');
    }
    //DELETE
    public function deleteRepresentative($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/students/representativeStudent')->with('thongbao', 'Xóa học viên thành công!');
    }

    public function deleteOpinion($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/students/opinionStudent')->with('thongbao', 'Xóa ý kiến học viên thành công!');

    }
}
