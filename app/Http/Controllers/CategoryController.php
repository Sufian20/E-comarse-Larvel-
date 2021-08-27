<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function AddCategory()
    {

        return view('backend.category.add_category');
    }

    function PostCategory(Request $request)
    {
         $request->validate([

            'category_name' => ['required', 'min:5', 'max:255', 'unique:categories'],
        ],[
            'category_name.required' => 'Chutto bondhu! Amar mone hoy category name dite vule gecho'

        ]);
        Category::insert([

            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
        ]);

        return redirect('view-category')->with('success', 'Category Added Successfuly');
    }

    function ViewCategory()
    {
        $categoris = category::paginate(3);
        return view('backend.category.view_category', compact('categoris'));
    }

    function DeleteCategory($id)
    {
        Category::findOrfail($id)->delete();
        return back()->with('success', 'Category deleted Successfuly');
    }

    function EditCategory($id){
        $category = Category::findOrfail($id);
        return  view('backend.category.edit', compact('category'));
    }

    function UpdateCategory(Request $request){

       Category::findOrfail($request->category_id)->update([

        'category_name' => $request->category_name,
        'updated_at' => Carbon::now()
       ]);
        return back()->with('success', 'Category Updated Successfuly');
    }
    

    function TrashCategory(){

        $categoris = Category::onlyTrashed()->paginate();
        return view('backend.category.trash-category', compact('categoris'));
    }

    function RestoreCategory($id){

        Category::withTrashed()->findOrfail($id)->restore();
        return back()->with('success', 'Category Resotor Successfully');
    }

    function ParmanentCategory($id){

        Category::withTrashed()->findOrfail($id)->forceDelete();
        return back()->with('success', 'Category Prmanent Deleted Successfully');
    }

}
