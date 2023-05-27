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
        $request->validate([
            'brand_name' => 'required',
            'brand_image' => 'required',
        ]);
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
}