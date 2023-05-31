<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Image;
use File;
use Str;


class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.subcategory.add', compact("categories"));
    }
    public function store(Request $request)
    {

        $subcategory = new SubCategory;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name);

        if ($request->hasFile('subcategory_image')) {
            $image = $request->file('subcategory_image');
            $custom_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('uploads/subcategory/' . $custom_name);
            Image::make($image)->fit(150, 150)->save($image_path);
            $subcategory->subcategory_image = $custom_name;
        }
        $subcategory->save();
        $notice = array(
            'message' => 'SubCategory Added Successfully',
            'type' => 'success'
        );
        return back()->with($notice);
    }
    public function manage()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategory.manage', compact('subcategories'));
    }

    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        $categories = Category::all();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);
        if ($request->subcategory_image) {
            if (File::exists(public_path('uploads/subcategory/' . $subcategory->subcategory_image))) {
                File::delete(public_path('uploads/subcategory/' . $subcategory->subcategory_image));
            }
            $image = $request->file('subcategory_image');
            $custom_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('uploads/subcategory/' . $custom_name);
            Image::make($image)->fit(150, 150)->save($image_path);
            $subcategory->subcategory_image = $custom_name;
        }
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name);
        $subcategory->update();

        $notice = array(
            'message' => 'SubCategory Updated Successfully',
            'type' => 'success'
        );

        return redirect()->route('subcategory.manage')->with($notice);
    }

    public function delete($id)
    {
        $subcategory = SubCategory::find($id);
        if (File::exists(public_path('uploads/subcategory/' . $subcategory->subcategory_image))) {
            File::delete(public_path('uploads/subcategory/' . $subcategory->subcategory_image));
        }
        $subcategory->delete();
        return back();
    }



}