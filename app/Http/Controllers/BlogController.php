<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function Blog(){
      $blogs =  Category::orderBy('category_name', 'asc')->get();
        return view('backend.blog.add_blog',[
            'blogs' => $blogs,
        ]);
    }

    function PostBlog(Request $request){

        $request->validate([
            'feature_image' => ['required', 'image'],
            'slug' => ['required', 'unique:blog']
        ]);

        if($request->hasFile('feature_image')){
            
         $image =  $request->file('feature_image');



        $ext = $request->slug .'-' .Str::lower(Str::random(3)). '.' .$image->getClientOriginalExtension();
           

           Image::make( $image)->resize(500, 364)->save(public_path('blogs/'.$ext));

           Blog::insert([
            
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'categroy_id' => $request->categroy_id, 
            'feature_image' =>  $ext,
            'created_at' =>Carbon::now(),
        ]);
        }
       
       
        return back()->with('success', 'Product Added Successfully');
    }

    function ViewBlog(){

        $blogs = Blog::with('category')->paginate(10);

        return view('backend.blog.view_blog',[
            'blogs' => $blogs,
        ]);
    }

    function DeleteBlog($id){
        Blog::findOrfail($id)->delete();

        return back()->with('success', 'Product Deleted Successfully');
        
    }

    function EditBlog($slug){
        $blog = Blog::where('slug', $slug)->first();
        $blogs = Category::orderBy('category_name', 'asc')->get();

        return view('backend.blog.edit_blog',[
            'blog' => $blog,
            'blogs' => $blogs
        ]);

    }

    function UpdateBlog(Request $request){

        if($request->hasFile('feature_image')){
            
            $image =  $request->file('feature_image');

            $old_img = Blog::findOrfail($request->blog_id)->feature_image;

            if(file_exists(public_path('blogs/'.$old_img))){
                unlink(public_path('blogs/'.$old_img));
    
    
    
            }
   
           $ext = $request->slug .'-' .Str::lower(Str::random(3)). '.' .$image->getClientOriginalExtension();
              
   
              Image::make( $image)->resize(500, 364)->save(public_path('blogs/'.$ext));

        Blog::findOrfail($request->blog_id)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'categroy_id' => $request->categroy_id, 
            'feature_image' =>  $ext,
            'updated_at' => Carbon::now(),
        ]);

        }

        else{
            Blog::findOrfail($request->blog_id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'categroy_id' => $request->categroy_id, 
                'updated_at' => Carbon::now(),
            ]);
        }

        return back()->with('success', 'Product Updated Successfully');
    }

   
}
