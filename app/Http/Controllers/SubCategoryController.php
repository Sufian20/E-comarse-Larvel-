<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Carbon;


class SubCategoryController extends Controller
{
    function AddSubCategory(){

        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('backend.subcategory.subcategroy', ['categories'=>$categories ]);
    }


    function PostSubCategory(Request $request){
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Sub Category Added Successfully');

    }
    
    function ViewSubCategory(){

        $subcategoris = SubCategory::paginate();
        return view('backend.subcategory.view_subcategory', ['subcategoris' => $subcategoris]);
    }
}
