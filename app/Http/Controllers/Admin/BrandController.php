<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Str;
use App\Models\Brand;


class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brand.add');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'brand_name' => 'required',
                'brand_image' => 'required',
            ],
            [
                'brand_name.required' => 'Please Enter Brand Name',
                'brand_image.required' => 'Please Select Brand Image',
            ]
        );

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name);

        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $custom_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('uploads/brand/' . $custom_name);
            Image::make($image)->fit(100, 100)->save($image_path);
            $brand->brand_image = $custom_name;
        }
        $brand->save();
        $notice = array(
            'message' => 'Brand Added Successfully',
            'type' => 'success'
        );
        return back()->with($notice);
    }
    public function manage()
    {
        $brands = Brand::all();
        return view('admin.brand.manage', compact('brands'));
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }
    public function delete($id)
    {
        $brand = Brand::find($id);
        if (File::exists(public_path('uploads/brand/' . $brand->brand_image))) {
            File::delete(public_path('uploads/brand/' . $brand->brand_image));
        }
        $brand->delete();
        return back();
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'brand_name' => 'required',
            ],
            [
                'brand_name.required' => 'Please Enter Brand Name',
            ]
        );
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name);
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $custom_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('uploads/brand/' . $custom_name);
            Image::make($image)->fit(100, 100)->save($image_path);
            $brand->brand_image = $custom_name;
        }
        $brand->update();
        $notice = array(
            'message' => 'Brand Updated Successfully',
            'type' => 'success'
        );
        return back()->with($notice);
    }

}