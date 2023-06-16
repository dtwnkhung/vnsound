<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\UserRepository;
use App\Repositories\SourceRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\ProductRepository;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTeacher()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"Danh sách"]
        ];
        return view('modules.teachers.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function indexStudent()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"Danh sách"]
        ];
        return view('modules.students.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getListTeachers(UserRepository $repository)
    {
        $teachers = $repository->getTeachers();

        return Datatables::of($teachers)
            ->addColumn('name', function ($user) {
                return '<a href="'. route('teachers.edit', $user->id) .'" class=""><i class="fa fa-eye"></i> '.$user->name.'</a>';
            })
            ->addColumn('created_at', function ($user) {
                return '<span>'.date('d-m-Y', strtotime($user->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($user) {
                return '<span>'.date('d-m-Y', strtotime($user->created_at)).'</span>';
            })
            ->rawColumns(['name','created_at','updated_at'])
            ->make(true);
    }

    public function getListStudents(UserRepository $repository)
    {
        $teachers = $repository->getStudents();

        return Datatables::of($teachers)
            ->addColumn('name', function ($user) {
                return '<a href="'. route('students.edit', $user->id) .'" class=""><i class="fa fa-eye"></i> '.$user->name.'</a>';
            })
            ->addColumn('created_at', function ($user) {
                return '<span>'.date('d-m-Y', strtotime($user->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($user) {
                return '<span>'.date('d-m-Y', strtotime($user->created_at)).'</span>';
            })
            ->rawColumns(['name','created_at','updated_at'])
            ->make(true);
    }

    public function view($id)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"View"]
        ];
        $item = $this->getSingleData($id);
        return view('modules.teachers.view', ['breadcrumbs' => $breadcrumbs,'data' => $item]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRepository $productRepository)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/teachers",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/teachers/')) {
            mkdir(public_path('images/teachers/'), 0777, true);
        }
        $classes= $productRepository->getListquery();
        return view('modules.teachers.add', [
            'breadcrumbs' => $breadcrumbs,
            'classes' => $classes,
        ]);
    }

    public function createStudent()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/students",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        if (!public_path('images/students/')) {
            mkdir(public_path('images/students/'), 0777, true);
        }
        return view('modules.students.add', ['breadcrumbs' => $breadcrumbs]);
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
            'name'                  => 'required|max:255',
            'email'                  => 'required|unique:users,email|max:255',
            'password'              => 'required|max:16|min:6',
            'images'              => 'required',
            'repassword'             => 'required|max:16|min:6|same:password',
        ];
        $arrMess  = [
            'name.required'         => 'Trường dữ liệu không được bỏ trống!',
            'name.max'              => 'Độ dài tối đa 255 kí tự!',
            'email.required'         => 'Trường dữ liệu không được bỏ trống!',
            'email.max'              => 'Độ dài tối đa 255 kí tự!',
            'email.unique'              => 'Email đã tồn tại trên hệ thống!',
            'images.required'       => 'Vui lòng chọn ảnh!',
            'password.required'       => 'Trường dữ liệu không được bỏ trống!',
            'password.max'              => 'Độ dài tối đa 16 kí tự!',
            'password.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.required'       => 'Trường dữ liệu không được bỏ trống!',
            'repassword.max'              => 'Độ dài tối đa 16 kí tự!',
            'repassword.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.same'              => 'Mật khẩu xác nhận không chính xác!',
        ];
        $user = new User();
        $this->validate($request, $arrRules, $arrMess);
        $images = [];
        foreach($request->file('images') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
            while (file_exists(public_path('images/teachers/').$filename)) {
                $filename =  Str::random(15).'.'.$extension;
            }
            try{
                $file->move(public_path('images/teachers/'), $filename);

            }catch (\Exception $e){
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die();
            }
            $img = Image::make(public_path('images/teachers/').$filename)->resize(370, 500);

            $img->save(public_path('images/teachers/').'400x400-'.$filename);
            $images[] = $filename;
        }
        $certificate = [];
        if($request->hasFile('certificate')){
            foreach($request->file('certificate') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/teachers/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/teachers/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/teachers/').$filename)->resize(370, 500);

                $img->save(public_path('images/teachers/').'400x400-'.$filename);
                $certificate[] = $filename;
            }
        }
        $user->images = implode(',', $images);
        $user->certificate = implode(',', $certificate);
        $user->name              = $request->name;
        $user->email              = $request->email;
        $user->date_of_birth              = $request->date_of_birth;
        $user->address              = $request->address;
        $user->education   	= $request->education;
        $user->experience   	= $request->experience;
        $user->class   	= $request->class;
        $user->english   	= $request->english;
        $user->status   	= $request->status;
        $user->link   	= $request->link;
        $user->password   	= Hash::make($request->password);
        $user->type   	= 1; //1-giasu|2-hocvien
        $user->save();
        return redirect('admin/teachers')->with('thongbao', 'Thêm mới user thành công!');
    }

    public function storeStudent(Request $request)
    {
        $arrRules =  [
            'name'                  => 'required|max:255',
            'email'                  => 'required|unique:users,email|max:255',
            'password'              => 'required|max:16|min:6',
            'images'              => 'required',
            'repassword'             => 'required|max:16|min:6|same:password',
        ];
        $arrMess  = [
            'name.required'         => 'Trường dữ liệu không được bỏ trống!',
            'name.max'              => 'Độ dài tối đa 255 kí tự!',
            'email.required'         => 'Trường dữ liệu không được bỏ trống!',
            'email.max'              => 'Độ dài tối đa 255 kí tự!',
            'email.unique'              => 'Email đã tồn tại trên hệ thống!',
            'images.required'       => 'Vui lòng chọn ảnh!',
            'password.required'       => 'Trường dữ liệu không được bỏ trống!',
            'password.max'              => 'Độ dài tối đa 16 kí tự!',
            'password.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.required'       => 'Trường dữ liệu không được bỏ trống!',
            'repassword.max'              => 'Độ dài tối đa 16 kí tự!',
            'repassword.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.same'              => 'Mật khẩu xác nhận không chính xác!',
        ];
        $user = new User();
        $this->validate($request, $arrRules, $arrMess);
        $images = [];
        foreach($request->file('images') as $file)
        {
            $extension = $file->getClientOriginalExtension();

            $filename =  Str::random(15).'.'.$extension;
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
            $img = Image::make(public_path('images/students/').$filename)->resize(370, 500);

            $img->save(public_path('images/students/').'400x400-'.$filename);
            $images[] = $filename;
        }
        $user->images = implode(',', $images);
        $user->name              = $request->name;
        $user->email              = $request->email;
        $user->date_of_birth              = $request->date_of_birth;
        $user->address              = $request->address;
        $user->status   	= $request->status;
        $user->password   	= Hash::make($request->password);
        $user->type   	= 2; //1-giasu|2-hocvien
        $user->save();
        return redirect('admin/students')->with('thongbao', 'Thêm mới user thành công!');
    }

    public function handlerImage(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename =  Str::random(15).'.'.$extension;
        while (file_exists(public_path('/images/teachers/').$filename)) {
            $filename =  Str::random(15).'.'.$extension;
        }
        try{
            $file->move(public_path('images/teachers/'), $filename);
            return response()->json(['urlImg'=>'/images/teachers/'.$filename]);

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
    public function edit($id, ProductRepository $productRepository)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/prodcuts",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $user = $this->getSingleData($id);
        $user->images = explode(',', $user->images);
        $user->certificate = explode(',', $user->certificate);
        $classes = $productRepository->getListquery();

        return view('modules.teachers.edit', [
            'breadcrumbs' => $breadcrumbs,
            'classes' => $classes,
            'user' => $user
        ]);
    }

    public function editStudent($id)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/prodcuts",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $user = $this->getSingleData($id);
        $user->images = explode(',', $user->images);
        $user->certificate = explode(',', $user->certificate);

        return view('modules.students.edit', ['breadcrumbs' => $breadcrumbs, 'user' => $user]);
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
            'name'                  => 'required|max:255',
        ];
        $arrMess  = [
            'name.required'         => 'Trường dữ liệu không được bỏ trống!',
            'name.max'              => 'Độ dài tối đa 255 kí tự!',
        ];
        $user = $this->getSingleData($id);

        $this->validate($request, $arrRules, $arrMess);

        if($request->hasFile('images')){
            $images = [];
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/teachers/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/teachers/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/teachers/').$filename)->resize(370, 500);

                $img->save(public_path('images/teachers/').'400x400-'.$filename);
                $images[] = $filename;
            }
        }
        if($request->hasFile('certificate')){
            $certificate = [];
            foreach($request->file('certificate') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/teachers/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/teachers/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/teachers/').$filename)->resize(370, 500);

                $img->save(public_path('images/teachers/').'400x400-'.$filename);
                $certificate[] = $filename;
            }

            $user->certificate = implode(',', $certificate);
        }

        $user->name              = $request->name;
        $user->date_of_birth              = $request->date_of_birth;
        $user->address              = $request->address;
        $user->education   	= $request->education;
        $user->experience   	= $request->experience;
        $user->class   	= $request->class;
        $user->english   	= $request->english;
        $user->status   	= $request->status;
        $user->link   	= $request->link;
        $user->save();
        return redirect('admin/teachers')->with('thongbao', 'Cập nhật user thành công!');
    }

    public function updateStudent(Request $request, $id)
    {
        $arrRules =  [
            'name'                  => 'required|max:255',
        ];
        $arrMess  = [
            'name.required'         => 'Trường dữ liệu không được bỏ trống!',
            'name.max'              => 'Độ dài tối đa 255 kí tự!',
        ];
        $user = $this->getSingleData($id);

        $this->validate($request, $arrRules, $arrMess);

        if($request->hasFile('images')){
            $images = [];
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/teachers/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/teachers/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/teachers/').$filename)->resize(370, 500);

                $img->save(public_path('images/teachers/').'400x400-'.$filename);
                $images[] = $filename;
            }
        }

        $user->name              = $request->name;
        $user->date_of_birth              = $request->date_of_birth;
        $user->address              = $request->address;
        $user->english   	= $request->english;
        $user->status   	= $request->status;
        $user->save();
        return redirect('admin/students')->with('thongbao', 'Cập nhật user thành công!');
    }


    public function changePassword($id)
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['link'=>"admin/prodcuts",'name'=>"Danh sách"],
            ['name'=>"Chỉnh sửa"]
        ];
        $user = $this->getSingleData($id);
        $user->images = explode(',', $user->images);
        $user->certificate = explode(',', $user->certificate);

        return view('modules.teachers.changePass', ['breadcrumbs' => $breadcrumbs, 'user' => $user]);
    }
    public function updatePasswordStudent(Request $request, $id)
    {
        $arrRules =  [
            'password'              => 'required|max:16|min:6',
            'repassword'             => 'required|max:16|min:6|same:password',
        ];
        $arrMess  = [
            'password.required'       => 'Trường dữ liệu không được bỏ trống!',
            'password.max'              => 'Độ dài tối đa 16 kí tự!',
            'password.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.required'       => 'Trường dữ liệu không được bỏ trống!',
            'repassword.max'              => 'Độ dài tối đa 16 kí tự!',
            'repassword.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.same'              => 'Mật khẩu xác nhận không chính xác!',
        ];
        $user = $this->getSingleData($id);
        $this->validate($request, $arrRules, $arrMess);
        $user->password   	= Hash::make($request->password);
        $user->save();
        return redirect('admin/students')->with('thongbao', 'Đổi mật khẩu thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/teachers')->with('thongbao', 'Xóa user thành công!');
    }
}
