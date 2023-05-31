<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use File;
use Image;
use Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.add');
    }
    public function store(Request $request)
    {


        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $custom_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('uploads/category/' . $custom_name);
            Image::make($image)->fit(150, 150)->save($image_path);
            $category->category_image = $custom_name;
        }
        $category->save();
        $notice = array(
            'message' => 'Category Added Successfully',
            'type' => 'success'
        );
        return back()->with($notice);
    }
    public function manage()
    {
        $categories = Category::all();
        return view('admin.category.manage', compact('categories'));
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if (File::exists(public_path('uploads/category/' . $category->category_image))) {
            File::delete(public_path('uploads/category/' . $category->category_image));
        }
        $category->delete();
        return back();
    }
    public function update(Request $request, $id)
    {

        $category = Category::find($id);
        if ($request->category_image) {
            if (File::exists(public_path('uploads/category/' . $category->category_image))) {
                File::delete(public_path('uploads/category/' . $category->category_image));
            }
            $image = $request->file('category_image');
            $custom_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('uploads/category/' . $custom_name);
            Image::make($image)->fit(150, 150)->save($image_path);
            $category->category_image = $custom_name;
            $category->category_name = $request->category_name;
            $category->category_slug = Str::slug($request->category_name);
            $category->update();
            $notice = array(
                'message' => 'Category Updated Successfully',
                'type' => 'success'
            );
            return redirect()->route('category.manage')->with($notice);
        } else {
            $category->category_name = $request->category_name;
            $category->category_slug = Str::slug($request->category_name);
            $category->update();
            $notice = array(
                'message' => 'Category Updated Successfully',
                'type' => 'success'
            );
            return redirect()->route('category.manage')->with($notice);
        }

    }
}