<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\SourceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Category;
use App\Repositories\ArtistRepository;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class ArtistController extends Controller
{
    public function __construct(ArtistRepository $repository)
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
        return view('modules.artists.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function getList()
    {
        $artists = $this->getListData();

        return Datatables::of($artists)
            ->addColumn('name', function ($product) {
                return '<a href="' . route('artists.edit', $product->id) . '" class=""><i class="fa fa-eye"></i> ' . $product->name . '</a>';
            })
            ->addColumn('images', function ($item) {
                return '<img src="' . url("/images/artists") . '/' . $item->images . '" width="150px" />';
            })
            ->addColumn('created_at', function ($product) {
                return '<span>' . date('d-m-Y', strtotime($product->created_at)) . '</span>';
            })
            ->addColumn('status', function ($product) {
                if ($product->status == 1) {
                    return 'Online';
                } else {
                    return 'Offline';
                }
            })
            ->addColumn('updated_at', function ($product) {
                return '<span>' . date('d-m-Y', strtotime($product->created_at)) . '</span>';
            })
            ->rawColumns(['name', 'images', 'created_at', 'updated_at'])
            ->make(true);
    }

    public function view($id)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['name' => "View"]
        ];
        $item = $this->getSingleData($id);
        return view('modules.artists.view', ['breadcrumbs' => $breadcrumbs, 'data' => $item]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRepository $userRepository)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['link' => "admin/artists", 'name' => "Danh sách"],
            ['name' => "Thêm mới"]
        ];
        if (!public_path('images/artists/')) {
            mkdir(public_path('images/artists/'), 0777, true);
        }
        $teachers = $userRepository->getTeachers();
        return view('modules.artists.add', ['breadcrumbs' => $breadcrumbs, 'teachers' => $teachers]);
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
        //     'images'                 => 'required',
        //     'banner'              => 'required',
        //     'profile'              => 'required',
        //     'project_1_title'              => 'required',
        //     'project_1_image'              => 'required',
        //     'project_1_text'              => 'required',
        //     'project_2_title'              => 'required',
        //     'project_2_image'              => 'required',
        //     'project_2_text'              => 'required',
        //     'bts_text'              => 'required',
        //     'bts_image'              => 'required',
        // ];
        // $arrMess  = [
        //     'name.required'         => 'Trường dữ liệu không được để trống!',
        //     'name.max'              => 'Độ dài tối đa 255 kí tự!',
        //     'images.required'        => 'Trường dữ liệu không được dể trống!',
        //     'banner.required'        => 'Trường dữ liệu không được dể trống!',
        //     'profile.required'        => 'Trường dữ liệu không được dể trống!',
        //     'project_1_title.required'        => 'Trường dữ liệu không được dể trống!',
        //     'project_1_image.required'        => 'Trường dữ liệu không được dể trống!',
        //     'project_1_text.required'        => 'Trường dữ liệu không được dể trống!',
        //     'project_2_title.required'        => 'Trường dữ liệu không được dể trống!',
        //     'project_2_text.required'        => 'Trường dữ liệu không được dể trống!',
        //     'project_2_image.required'        => 'Trường dữ liệu không được dể trống!',
        //     'bts_text.required'        => 'Trường dữ liệu không được dể trống!',
        //     'bts_image.required'        => 'Trường dữ liệu không được dể trống!',
        // ];
        $product = new Artist();
        // var_dump($request->name);exit();
        // $this->validate($request, $arrRules, $arrMess);
        $images = [];
        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename)->resize(475, 250);

                $img->save(public_path('images/artists/') . '400x400-' . $filename);
                $images[] = $filename;
            }
        }

        $banner = [];
        if ($request->has('banner')) {
            foreach ($request->file('banner') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'banner-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $banner[] = $filename;
            }
        }

        $clubs = [];
        if ($request->has('clubs')) {
            foreach ($request->file('clubs') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'clubs-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $clubs[] = $filename;
            }
        }
        $partners = [];
        if ($request->has('partners')) {
            foreach ($request->file('partners') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'partners-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $partners[] = $filename;
            }
        }

        $project_1_image = [];
        if ($request->has('project_1_image')) {
            foreach ($request->file('project_1_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'project_1_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $project_1_image[] = $filename;
            }
        }

        $project_2_image = [];
        if ($request->has('project_2_image')) {
            foreach ($request->file('project_2_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'project_2_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $project_2_image[] = $filename;
            }
        }
        $bts_image = [];
        if ($request->has('bts_image')) {
            foreach ($request->file('bts_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'bts_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $bts_image[] = $filename;
            }
        }

        $life_style_1 = [];
        if ($request->has('life_style_1')) {
            foreach ($request->file('life_style_1') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_1-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_1[] = $filename;
            }
        }

        $life_style_2 = [];
        if ($request->has('life_style_2')) {
            foreach ($request->file('life_style_2') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_2-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_2[] = $filename;
            }
        }

        $life_style_3 = [];
        if ($request->has('life_style_3')) {
            foreach ($request->file('life_style_3') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_3-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_3[] = $filename;
            }
        }

        $life_style_4 = [];
        if ($request->has('life_style_4')) {
            foreach ($request->file('life_style_4') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_4-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_4[] = $filename;
            }
        }
        $life_style_5 = [];
        if ($request->has('life_style_5')) {
            foreach ($request->file('life_style_5') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_5-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_5[] = $filename;
            }
        }
        $life_style_6 = [];
        if ($request->has('life_style_6')) {
            foreach ($request->file('life_style_6') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename = 'life_style_6-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename = Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_6[] = $filename;
            }
        }
        $product->images = implode(',', $images);
        $product->banner = implode(',', $banner);
        $product->clubs = implode(',', $clubs);
        $product->partners = implode(',', $partners);
        $product->project_1_image = implode(',', $project_1_image);
        $product->project_2_image = implode(',', $project_2_image);
        $product->bts_image = implode(',', $bts_image);
        $product->life_style_1 = implode(',', $life_style_1);
        $product->life_style_2 = implode(',', $life_style_2);
        $product->life_style_3 = implode(',', $life_style_3);
        $product->life_style_4 = implode(',', $life_style_4);
        $product->life_style_5 = implode(',', $life_style_5);
        $product->life_style_6 = implode(',', $life_style_6);
        $product->name              = $request->name;
        $product->profile       = $request->profile;
        $product->project_1_title       = $request->project_1_title;
        $product->project_2_title       = $request->project_2_title;
        $product->project_1_text       = $request->project_1_text;
        $product->project_2_text       = $request->project_2_text;
        $product->bts_text       = $request->bts_text;
        $product->bts_link_fb       = $request->bts_link_fb;
        $product->bts_link_ins       = $request->bts_link_ins;
        $product->bts_link_tt       = $request->bts_link_tt;
        $product->bts_link_yt       = $request->bts_link_yt;
        $product->bts_link_sc       = $request->bts_link_sc;
        $product->save();
        return redirect('admin/artists')->with('thongbao', 'Thêm mới nghệ sĩ thành công!');
    }

    public function handlerImage(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename =  Str::random(15) . '.' . $extension;
        while (file_exists(public_path('/images/artists/') . $filename)) {
            $filename =  Str::random(15) . '.' . $extension;
        }
        try {
            $file->move(public_path('images/artists/'), $filename);
            return response()->json(['urlImg' => '/images/artists/' . $filename]);
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
    public function edit(UserRepository $userRepository, $id)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
            ['link' => "admin/artists", 'name' => "Danh sách"],
            ['name' => "Chỉnh sửa"]
        ];
        $item = $this->getSingleData($id);
        $item->partners = explode(',', $item->partners);
        $item->project_1_image = explode(',', $item->project_1_image);
        $item->project_2_image = explode(',', $item->project_2_image);
        $item->clubs = explode(',', $item->clubs);
        return view('modules.artists.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
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
        //     'profile'              => 'required',
        //     'bts_text'              => 'required',
        // ];
        // $arrMess  = [
        //     'name.required'         => 'Trường dữ liệu không được dể trống!',
        //     'name.max'              => 'Độ dài tối đa 255 kí tự!',
        //     'profile.required'        => 'Trường dữ liệu không được dể trống!',
        //     'bts_text.required'        => 'Trường dữ liệu không được dể trống!',
        // ];
        $item = $this->getSingleData($id);

        // $this->validate($request, $arrRules, $arrMess);
        if ($request->has('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename =  Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename)->resize(475, 250);

                $img->save(public_path('images/artists/') . '400x400-' . $filename);
                $images[] = $filename;
            }
            $item->images = implode(',', $images);
        }

        if ($request->has('banner')) {
            $banner = [];
            foreach ($request->file('banner') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'banner-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $banner[] = $filename;
            }
            $item->banner = implode(',', $banner);
        }

        if ($request->has('clubs')) {
            $clubs = [];
            foreach ($request->file('clubs') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'clubs-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $clubs[] = $filename;
            }
            $clubs_old = explode(",", $item->clubs);
            $club_news = array_merge($clubs, $clubs_old);
            $item->clubs = implode(',', $club_news);
        }

        if ($request->has('partners')) {
            $partners = [];
            foreach ($request->file('partners') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename =  'partners-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $partners[] = $filename;
            }
            $partners_old = explode(",", $item->partners);
            $partners_news = array_merge($partners, $partners_old);
            $item->partners = implode(',', $partners_news);
        }

        if ($request->has('project_1_image')) {
            $project_1_image = [];
            foreach ($request->file('project_1_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'project_1_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $project_1_image[] = $filename;
            }
            $project_1_image_old = explode(",", $item->project_1_image);
            $project_1_image_new = array_merge($project_1_image, $project_1_image_old);
            $item->project_1_image = implode(',', $project_1_image_new);
        }

        if ($request->has('project_2_image')) {
            $project_2_image = [];
            foreach ($request->file('project_2_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'project_2_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $project_2_image[] = $filename;
            }
            $project_2_image_old = explode(",", $item->project_2_image);
            $project_2_image_new = array_merge($project_2_image, $project_2_image_old);
            $item->project_2_image = implode(',', $project_2_image_new);
        }

        if ($request->has('bts_image')) {
            $bts_image = [];
            foreach ($request->file('bts_image') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'bts_image-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $bts_image[] = $filename;
            }
            $item->bts_image = implode(',', $bts_image);
        }

        if ($request->has('life_style_1')) {
            $life_style_1 = [];
            foreach ($request->file('life_style_1') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_1-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_1[] = $filename;
            }
            $item->life_style_1 = implode(',', $life_style_1);
        }

        if ($request->has('life_style_2')) {
            $life_style_2 = [];
            foreach ($request->file('life_style_2') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_2-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_2[] = $filename;
            }
            $item->life_style_2 = implode(',', $life_style_2);
        }

        if ($request->has('life_style_3')) {
            $life_style_3 = [];
            foreach ($request->file('life_style_3') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_3-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_3[] = $filename;
            }
            $item->life_style_3 = implode(',', $life_style_3);
        }

        if ($request->has('life_style_4')) {
            $life_style_4 = [];
            foreach ($request->file('life_style_4') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_4-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_4[] = $filename;
            }
            $item->life_style_4 = implode(',', $life_style_4);
        }

        if ($request->has('life_style_5')) {
            $life_style_5 = [];
            foreach ($request->file('life_style_5') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename =  'life_style_5-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename =  Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_5[] = $filename;
            }
            $item->life_style_5 = implode(',', $life_style_5);
        }

        if ($request->has('life_style_6')) {
            $life_style_6 = [];
            foreach ($request->file('life_style_6') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename = 'life_style_6-' . Str::random(15) . '.' . $extension;
                while (file_exists(public_path('images/artists/') . $filename)) {
                    $filename = Str::random(15) . '.' . $extension;
                }
                try {
                    $file->move(public_path('images/artists/'), $filename);
                } catch (\Exception $e) {
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/artists/') . $filename);

                $img->save(public_path('images/artists/') . $filename);
                $life_style_6[] = $filename;
            }
            $item->life_style_6 = implode(',', $life_style_6);
        }
        $item->name              = $request->name;
        $item->profile       = $request->profile;
        $item->project_1_title       = $request->project_1_title;
        $item->project_2_title       = $request->project_2_title;
        $item->project_1_text       = $request->project_1_text;
        $item->project_2_text       = $request->project_2_text;
        $item->bts_text       = $request->bts_text;
        $item->bts_link_fb       = $request->bts_link_fb;
        $item->bts_link_ins       = $request->bts_link_ins;
        $item->bts_link_tt       = $request->bts_link_tt;
        $item->bts_link_yt       = $request->bts_link_yt;
        $item->bts_link_sc       = $request->bts_link_sc;
        $item->save();
        return redirect('admin/artists')->with('thongbao', 'Cập nhật nghệ sĩ thành công!');
    }
    //DELETE
    public function delete($id)
    {
        $record = $this->repository->delete($id);
        return redirect('admin/artists')->with('thongbao', 'Xóa nghệ sĩ thành công!');
    }
    //Delete image clubs
    public function delete_image_clubs(Request $request)
    {
        $id = $request->club_id;
        $item = $this->getSingleData($id);
        $clubs = explode(',', $item->clubs);
        foreach ($clubs as $key => $value) {
            if ($key == $request->image_id) {
                unset($clubs[$key]);
            }
        }
        $item->clubs = implode(',', $clubs);
        $item->save();
        echo 1;
        // return redirect('admin/artists')->with('thongbao', 'Xóa ảnh clubs thành công!');
    }
    //Delete image pather
    public function delete_image_partner(Request $request)
    {
        $id = $request->partner_id;
        $item = $this->getSingleData($id);
        $partners = explode(',', $item->partners);
        foreach ($partners as $key => $value) {
            if ($key == $request->image_id) {
                unset($partners[$key]);
            }
        }
        $item->partners = implode(',', $partners);
        $item->save();
        echo 1;
        // return redirect('admin/artists')->with('thongbao', 'Xóa ảnh clubs thành công!');
    }
    public function delete_image_project1(Request $request)
    {
        $id = $request->project_1_image;
        $item = $this->getSingleData($id);
        $project_1_image = explode(',', $item->project_1_image);
        foreach ($project_1_image as $key => $value) {
            if ($key == $request->image_id) {
                unset($project_1_image[$key]);
            }
        }
        $item->project_1_image = implode(',', $project_1_image);
        $item->save();
        echo 1;
        // return redirect('admin/artists')->with('thongbao', 'Xóa ảnh clubs thành công!');
    }
    public function delete_image_project2(Request $request)
    {
        $id = $request->project_2_image;
        $item = $this->getSingleData($id);
        $project_2_image = explode(',', $item->project_2_image);
        foreach ($project_2_image as $key => $value) {
            if ($key == $request->image_id) {
                unset($project_2_image[$key]);
            }
        }
        $item->project_2_image = implode(',', $project_2_image);
        $item->save();
        echo 1;
        // return redirect('admin/artists')->with('thongbao', 'Xóa ảnh clubs thành công!');
    }
}
