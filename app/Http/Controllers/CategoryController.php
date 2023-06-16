<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Models\Category;
use App\Product;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function __construct(CategoryRepository $repository)
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
        return view('modules.categories.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function getList()
    {
        $items = $this->getListData();
        return Datatables::of($items)
            ->addColumn('name', function ($item) {
                return '<a href="'. route('categories.edit', $item->id) .'" class=""><i class="fa fa-eye"></i> '.$item->name.'</a>';
            })
            ->addColumn('created_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->addColumn('updated_at', function ($item) {
                return '<span>'.date('d-m-Y', strtotime($item->created_at)).'</span>';
            })
            ->rawColumns(['name','created_at','updated_at'])
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
            ['link'=>"admin/categories",'name'=>"Danh sách"],
            ['name'=>"Thêm mới"]
        ];
        return view('modules.categories.add', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|max:255|unique:category,name',
            ],
            [
                'name.required' => 'Vui lòng nhập tên danh mục!',
                'name.max' => 'Tên danh có độ dài tối đa 255 kí tự!',
            ]);

        $category 				= new Category();
        $category->name 		= $request->name;
        $category->created_at   = date('Y-m-d H:i:s');
        $category->updated_at   = date('Y-m-d H:i:s');
        $category->save();
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $category = $this->getSingleData($id);
        return view('modules.categories.view', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->getSingleData($id);
        return view('modules.categories.edit', ['category' => $category]);
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
        $this->validate($request,
            [
                'name' => 'required|max:255|unique:category,name,' . $id,
            ],
            [
                'name.required' => 'Vui lòng nhập tên danh mục!',
                'name.max' => 'Tên danh có độ dài tối đa 255 kí tự!',
            ]);
        $category = $this->getSingleData($id);
        $category->name 		= $request->name;
        $category->updated_at   = date('Y-m-d H:i:s');
        $category->save();
        return redirect('admin/categories')->with('thongbao', 'Cập nhật danh mục thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/categories')->with('thongbao', 'Xóa danh mục thành công!');
    }
}
