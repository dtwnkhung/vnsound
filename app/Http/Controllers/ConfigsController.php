<?php

namespace App\Http\Controllers;

use App\Repositories\ConfigsRepository;
use Illuminate\Http\Request;
use App\Models\Config;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\Common;

class ConfigsController extends Controller
{
    public function __construct(ConfigsRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"],
            ['name'=>"Cấu hình"]
        ];
        if (!public_path('images/configs/')) {
            mkdir(public_path('images/configs/'), 0777, true);
        }
        $item = $this->getSingleData(1);
        return view('modules.configs.edit', ['breadcrumbs' => $breadcrumbs, 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $arrRules =  [
        ];
        $arrMess  = [
        ];
        $item = $this->getSingleData(1);
        if($item == null){
            $item = new Config();
        }
        if($request->has('logo')){
            $images = [];
            foreach($request->file('logo') as $file)
            {
                $extension = $file->getClientOriginalExtension();

                $filename =  Str::random(15).'.'.$extension;
                while (file_exists(public_path('images/configs/').$filename)) {
                    $filename =  Str::random(15).'.'.$extension;
                }
                try{
                    $file->move(public_path('images/configs/'), $filename);

                }catch (\Exception $e){
                    echo "<pre>";
                    print_r($e->getMessage());
                    echo "</pre>";
                    die();
                }
                $img = Image::make(public_path('images/configs/').$filename)->resize(600, 400);

                $img->save(public_path('images/configs/').'100x50-'.$filename);
                $images[] = $filename;
            }
            $item->logo = implode(',', $images);
        }
        $item->company_name              = $request->company_name;
        $item->id              = 1;
        $item->phone        = $request->phone;
        $item->email        = $request->email;
        $item->address        = $request->address;
        $item->description        = $request->description;
        $item->save();
        return redirect('admin/configs/edit')->with('thongbao', 'Cập nhật config thành công!');
    }

    public function handlerImage(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename =  Str::random(15).'.'.$extension;
        while (file_exists(public_path('/images/configs/').$filename)) {
            $filename =  Str::random(15).'.'.$extension;
        }
        try{
            $file->move(public_path('images/configs/'), $filename);
            return response()->json(['urlImg'=>'/images/configs/'.$filename]);

        }catch (\Exception $e){
            echo "<pre>";
            print_r($e->getMessage());
            echo "</pre>";
            die();
        }
    }
}
