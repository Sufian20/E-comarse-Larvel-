<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductImage;
use App\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;





class ProductController extends Controller
{
    function AddProduct(){

        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategories = SubCategory::orderBy('subcategory_name', 'asc')->get();
        return view('backend.product.add_product',[
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);

    }

    function PostProduct(Request $request){
        $request->validate([
            'product_thumbnil' => ['required', 'image'],
            'slug' => ['required', 'unique:products']
        ]);

        if($request->hasFile('product_thumbnil')){
            $image = $request->file('product_thumbnil');

           $ext = $request->slug .'-' .Str::lower(Str::random(3)). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(600, 622)->save(public_path('thumbnil/'.$ext), 50);


        $product_id =  Product::insertGetId([
                'product_name' => $request->product_name,
                'slug'  => $request->slug,
                'categroy_id'=> $request->categroy_id,
                'subcategroy_id' => $request->subcategroy_id,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_thumbnil' => $ext,
                'created_at' => Carbon::now()

            ]);
           if($request->hasFile('product_image')){
                $image = $request->file('product_image');
                    foreach($image as $img){
                        $ext1 = $request->slug .'-' .Str::lower(Str::random(3)). '.' .$img->getClientOriginalExtension();
                         Image::make($img)->resize(600, 622)->save(public_path('product/gallery/'.$ext1), 50);

                         ProductImage::insert([
                            'product_id' => $product_id,
                            'product_image' =>  $ext1,
                            'created_at' => Carbon::now()
                         ]);

                    }

            }

        }


        return back()->with('success', 'Product Added Successfully');
    }

    function ViewProduct(){
        $products = Product::with('category')->paginate(10);
        return view('backend.product.view_product',[
            'products' => $products,
     ]);
    }

    function DeleteProduct($id){
        Product::findOrfail($id)->delete();
        return back()->with('success', 'Product Deleted Successfully');
    }

    function TrashProduct(){
        $products = Product::onlyTrashed()->with('category')->paginate(10);
        return view('backend.product.trash_product',[
            'products' => $products,
        ]);
    }

    function ParmanentProduct($id){
        $old_img = Product::onlyTrashed()->findOrfail($id)->product_thumbnil;

        if(file_exists(public_path('thumbnil/'.$old_img))){
            unlink(public_path('thumbnil/'.$old_img));

            Product::onlyTrashed()->findOrfail($id)->forceDelete();
        }

        return back()->with('success', 'Product Parmanent Deleted Successfully');



    }

    function GetSubCategory($id){
        $sub_cat = SubCategory::where('category_id', $id)->orderBy('subcategory_name', 'asc')->get();

        return response()->json($sub_cat);
    }

    function EditProduct($slug){
       $product = Product::where('slug', $slug)->first();
       $categories = Category::orderBy('category_name', 'asc')->get();
        return view('backend.product.edit_product',[
            'product' => $product,
            'categories' => $categories
        ]);
    }

    function UpdateProduct(Request $request){
        $slug = $request->slug;

        if($request->hasFile('product_thumbnil')){
            $image = $request->file('product_thumbnil');

            $old_img = Product::findOrfail($request->product_id)->product_thumbnil;

        if(file_exists(public_path('thumbnil/'.$old_img))){
            unlink(public_path('thumbnil/'.$old_img));



        }

           $ext = $request->slug .'-' .Str::lower(Str::random(3)). '.' .$image->getClientOriginalExtension();

            Image::make($image)->resize(600, 622)->save(public_path('thumbnil/'.$ext), 50);

            Product::findOrfail($request->product_id)->update([
                'product_name' => $request->product_name,
                'slug'  => $slug,
                'categroy_id'=> $request->categroy_id,
                'subcategroy_id' => $request->subcategroy_id,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_thumbnil' => $ext,
                'updated_at' => Carbon::now()




        ]);

    }
        else{
            Product::findOrfail($request->product_id)->update([
                'product_name' => $request->product_name,
                'slug'  => $slug,
                'categroy_id'=> $request->categroy_id,
                'subcategroy_id' => $request->subcategroy_id,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'updated_at' => Carbon::now()
            ]);


        }

        return redirect(route('EditProduct', $slug))->with('success', 'Product Updated Successfully');
    }

    //================== PRODUCT SECTION STATUS ========================

 /*   public function ViewProductSection($id){
        $pro = Product::where('id', $id)->get();

        return view('backend.product.view_product', compact('pro'));
    }

    public function PostProductSection(Request $request){
         
        Product::findOrFail($request->product_id)->update([
            'product_section_status' => $request->product_section_status,
        ]);

        return $request->all();
    }
    */
}
