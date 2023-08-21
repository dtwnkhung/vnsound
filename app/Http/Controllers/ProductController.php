<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\ArtistRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SourceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Repositories\ProductRepository;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class ProductController extends Controller
{
    public function __construct(ProductRepository $repository)
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
            ['link' => "home", 'name' => "Home"], ['name' => "Danh sách"]
        ];
        return view('modules.products.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $products = $this->getListData();
        return Datatables::of($products)
            ->addColumn('name', function ($product) {
                return '<a href="' . route('products.edit', $product->id) . '" class=""><i class="fa fa-eye"></i> ' . $product->name . '</a>';
            })
            // ->addColumn('teacher_id', function ($product) {
            //     if ($product->teacher) {
            //         return '<a href="' . route('artists.edit', $product->teacher->id) . '" class=""><i class="fa fa-eye"></i> ' . $product->teacher->name . '</a>';
            //     }
            //     return '';
            // })
            ->addColumn('created_at', function ($product) {
                return '<span>' . date('d-m-Y', strtotime($product->created_at)) . '</span>';
            })
            ->addColumn('updated_at', function ($product) {
                return '<span>' . date('d-m-Y', strtotime($product->created_at)) . '</span>';
            })
            ->rawColumns(['name', 'teacher_id', 'created_at', 'updated_at'])
            ->make(true);
    }

    public function view($id)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['name' => "View"]
        ];
        $item = $this->getSingleData($id);
        return view('modules.products.view', ['breadcrumbs' => $breadcrumbs, 'data' => $item]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ArtistRepository $artistRepository)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['link' => "admin/prodcuts", 'name' => "Danh sách"],
            ['name' => "Thêm mới"]
        ];
        if (!public_path('images/products/')) {
            mkdir(public_path('images/products/'), 0777, true);
        }
        $teachers = $artistRepository->getList();
        return view('modules.products.add', ['breadcrumbs' => $breadcrumbs, 'teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $arrRules =  [
        //     'name'                  => 'required|max:255',
        //     'sub_name'                  => 'required|max:255',
        //     'images'                 => 'required',
        //     'description'                 => 'required',
        //     'block_1_title'                 => 'required',
        //     'block_2_title'                 => 'required',
        //     'block_3_title'                 => 'required',
        //     'block_1_content'                 => 'required',
        //     'block_2_content'                 => 'required',
        //     'block_3_content'                 => 'required',
        //     'free_price'                 => 'required',
        //     'basic_price'                 => 'required',
        //     'premium_price'                 => 'required',
        //     'free_benefit'                 => 'required',
        //     'basic_benefit'                 => 'required',
        //     'pre_benefit'                 => 'required',
        // ];
        // $arrMess  = [
        //     'name.required'         => 'Trường dữ liệu không được để trống!',
        //     'name.max'              => 'Độ dài tối đa 255 kí tự!',
        //     'sub_name.required'         => 'Trường dữ liệu không được để trống!',
        //     'sub_name.max'              => 'Độ dài tối đa 255 kí tự!',
        //     'description.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_1_title.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_2_title.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_3_title.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_1_content.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_2_content.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_3_content.required'         => 'Trường dữ liệu không được để trống!',
        //     'free_price.required'         => 'Trường dữ liệu không được để trống!',
        //     'basic_price.required'         => 'Trường dữ liệu không được để trống!',
        //     'premium_price.required'         => 'Trường dữ liệu không được để trống!',
        //     'free_benefit.required'         => 'Trường dữ liệu không được để trống!',
        //     'basic_benefit.required'         => 'Trường dữ liệu không được để trống!',
        //     'pre_benefit.required'         => 'Trường dữ liệu không được để trống!',
        // ];
        $product = new Product();
        // $this->validate($request, $arrRules, $arrMess);
        $images = [];
        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename)->resize(370, 500);

                $img->save(public_path('images/products/') . '400x400-' . $filename);
                $images[] = $filename;
            }
        }

        $images_artist = [];
        if ($request->has('images_artist')) {
            foreach ($request->file('images_artist') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename)->resize(475, 250);

                $img->save(public_path('images/products/') . '400x400-' . $filename);
                $images_artist[] = $filename;
            }
        }

        $block_1_image = [];
        if ($request->has('block_1_image')) {
            foreach ($request->file('block_1_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'block_1_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $block_1_image[] = $filename;
            }
        }

        $block_2_image = [];
        if ($request->has('block_2_image')) {
            foreach ($request->file('block_2_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'block_2_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $block_2_image[] = $filename;
            }
        }

        $block_3_image = [];
        if ($request->has('block_3_image')) {
            foreach ($request->file('block_3_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'block_3_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $block_3_image[] = $filename;
            }
        }

        $comments = [];
        if ($request->has('comments')) {
            foreach ($request->file('comments') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'comments-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $comments[] = $filename;
            }
        }

        $product->images = implode(',', $images);
        $product->images_artist = implode(',', $images_artist);
        $product->profile_artist = $request->profile_artist;
        $product->block_1_image = implode(',', $block_1_image);
        $product->block_2_image = implode(',', $block_2_image);
        $product->block_3_image = implode(',', $block_3_image);
        $product->comments = implode(',', $comments);

        $product->name              = $request->name;
        $product->name_artist              = $request->name_artist;
        $product->sub_name              = $request->sub_name;
        $product->description       = $request->description;
        $product->start_time       = $request->start_time;
        $product->end_time       = $request->end_time;
        // $product->teacher_id       = $request->teacher_id;
        $product->block_1_title       = $request->block_1_title;
        $product->block_2_title       = $request->block_2_title;
        $product->block_3_title       = $request->block_3_title;
        $product->block_1_content       = $request->block_1_content;
        $product->block_2_content       = $request->block_2_content;
        $product->block_3_content       = $request->block_3_content;
        $product->free_price       = $request->free_price;
        $product->basic_price       = $request->basic_price;
        $product->premium_price       = $request->premium_price;
        $product->slug       = $this->string_to_slug($request->name);
        $product->free_benefit       = implode(',', $request->free_benefit);
        $product->basic_benefit       = implode(',', $request->basic_benefit);
        $product->pre_benefit       = implode(',', $request->pre_benefit);
        $product->save();
        return redirect('admin/products')->with('thongbao', 'Thêm mới khóa học thành công!');
    }

    public function handlerImage(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename =  Str::random(15) . '.' . $extension;
        while (file_exists(public_path('/images/products/') . $filename)) {
            $filename =  Str::random(15) . '.' . $extension;
        }
        try {
            $file->move(public_path('images/products/'), $filename);
            return response()->json(['urlImg' => '/images/products/' . $filename]);
        } catch (\Exception $e) {
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
    public function edit(ArtistRepository $artistRepository, $id)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['link' => "admin/prodcuts", 'name' => "Danh sách"],
            ['name' => "Chỉnh sửa"]
        ];
        $item  = $this->getSingleData($id);
        $teachers = $artistRepository->getList();
        $item->comments = explode(',', $item->comments);
        return view('modules.products.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item, 'teachers' => $teachers]);
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
        // $arrRules =  [
        //     'name'                  => 'required|max:255',
        //     'sub_name'                  => 'required|max:255',
        //     'description'                 => 'required',
        //     'block_1_title'                 => 'required',
        //     'block_2_title'                 => 'required',
        //     'block_3_title'                 => 'required',
        //     'block_1_content'                 => 'required',
        //     'block_2_content'                 => 'required',
        //     'block_3_content'                 => 'required',
        //     'free_price'                 => 'required',
        //     'basic_price'                 => 'required',
        //     'premium_price'                 => 'required',
        //     'free_benefit'                 => 'required',
        //     'basic_benefit'                 => 'required',
        //     'pre_benefit'                 => 'required',
        // ];
        // $arrMess  = [
        //     'name.required'         => 'Trường dữ liệu không được để trống!',
        //     'name.max'              => 'Độ dài tối đa 255 kí tự!',
        //     'sub_name.required'         => 'Trường dữ liệu không được để trống!',
        //     'sub_name.max'              => 'Độ dài tối đa 255 kí tự!',
        //     'description.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_1_title.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_2_title.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_3_title.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_1_content.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_2_content.required'         => 'Trường dữ liệu không được để trống!',
        //     'block_3_content.required'         => 'Trường dữ liệu không được để trống!',
        //     'free_price.required'         => 'Trường dữ liệu không được để trống!',
        //     'basic_price.required'         => 'Trường dữ liệu không được để trống!',
        //     'premium_price.required'         => 'Trường dữ liệu không được để trống!',
        //     'free_benefit.required'         => 'Trường dữ liệu không được để trống!',
        //     'basic_benefit.required'         => 'Trường dữ liệu không được để trống!',
        //     'pre_benefit.required'         => 'Trường dữ liệu không được để trống!',
        // ];
        $product = $this->getSingleData($id);

        // $this->validate($request, $arrRules, $arrMess);

        if ($request->has('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename)->resize(370, 500);

                $img->save(public_path('images/products/') . '400x400-' . $filename);
                $images[] = $filename;
            }
            $product->images = implode(',', $images);
        }

        if ($request->has('images_artist')) {
            $images_artist = [];
            foreach ($request->file('images_artist') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename)->resize(475, 250);

                $img->save(public_path('images/products/') . '400x400-' . $filename);
                $images_artist[] = $filename;
            }
            $product->images_artist = implode(',', $images_artist);
        }

        if ($request->has('block_1_image')) {
            $block_1_image = [];
            foreach ($request->file('block_1_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename = 'block_1_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename = Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $block_1_image[] = $filename;
            }
            $product->block_1_image = implode(',', $block_1_image);
        }

        if ($request->has('block_2_image')) {
            $block_2_image = [];
            foreach ($request->file('block_2_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename = 'block_2_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename = Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $block_2_image[] = $filename;
            }
            $product->block_2_image = implode(',', $block_2_image);
        }

        if ($request->has('block_3_image')) {
            $block_3_image = [];
            foreach ($request->file('block_3_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename = 'block_3_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename = Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $block_3_image[] = $filename;
            }
            $product->block_3_image = implode(',', $block_3_image);
        }
        if ($request->has('comments')) {
            $comments = [];
            foreach ($request->file('comments') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename = 'comments-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/products/') . $filename)) {
                    $filename = Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/products/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/products/') . $filename);

                $img->save(public_path('images/products/') . $filename);
                $comments[] = $filename;
            }
            $product->comments = implode(',', $comments);
        }
        $product->name              = $request->name;
        $product->name_artist              = $request->name_artist;
        $product->profile_artist = $request->profile_artist;
        $product->sub_name              = $request->sub_name;
        $product->description       = $request->description;
        $product->start_time       = $request->start_time;
        $product->end_time       = $request->end_time;
        // $product->teacher_id       = $request->teacher_id;
        $product->block_1_title       = $request->block_1_title;
        $product->block_2_title       = $request->block_2_title;
        $product->block_3_title       = $request->block_3_title;
        $product->block_1_content       = $request->block_1_content;
        $product->block_2_content       = $request->block_2_content;
        $product->block_3_content       = $request->block_3_content;
        $product->free_price       = $request->free_price;
        $product->basic_price       = $request->basic_price;
        $product->premium_price       = $request->premium_price;
        $product->slug       = $this->string_to_slug($request->name);
        $product->free_benefit       = implode(',', $request->free_benefit);
        $product->basic_benefit       = implode(',', $request->basic_benefit);
        $product->pre_benefit       = implode(',', $request->pre_benefit);
        $product->save();
        return redirect('admin/products')->with('thongbao', 'Cập nhật khóa học thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/products')->with('thongbao', 'Xóa khóa học thành công!');
    }

    public function string_to_slug($str) {
        $str = trim($str); // trim
        $str = mb_strtolower($str, 'UTF-8'); // Convert to lowercase using UTF-8 encoding
    
        // remove accents, swap ñ for n, etc
        $from = "àáäâạảèéëêệìíïîòóöôọơởỡửữưùúüûñç·/_,:;";
        $to = "aaaaaaeeeeeiiiioooooooouuuuuuunc------";
        for ($i = 0, $l = mb_strlen($from, 'UTF-8'); $i < $l; $i++) {
            $str = str_replace(mb_substr($from, $i, 1, 'UTF-8'), mb_substr($to, $i, 1, 'UTF-8'), $str);
        }
    
        $str = preg_replace('/[^a-z0-9 -]/', '', $str); // remove invalid chars
        $str = preg_replace('/\s+/', '-', $str); // collapse whitespace and replace by -
        $str = preg_replace('/-+/', '-', $str); // collapse dashes
    
        return $str;
    }
}
