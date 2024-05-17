<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    // this method will show products page 
    public function index(){
        $products = Product::orderBy('created_at','DESC')->get();
     return view("products.index",compact('products'));
    }




    // this method will show create products page 
    public function create(){
      return view("products.create");
    }




    // this method will store a product in db 
    public function store(Request $request){
        // dd($request->all());
        $rule =[
        'name' => 'required|min:5',
        'sku' => 'required|min:5',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
       
        if($request->image !=""){
            $rule['image'] = 'image';
        }

      $validator =  Validator::make($request->all(), $rule);
       if($validator->fails()){
          return redirect()->route('products.create')->withInput()->withErrors($validator);
       }
    //    here we will insert product in db
     $product = new Product();
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->save();
    
    if($request->image !=""){
     // here we will store image 
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time().'.'.$ext;

    // save image to products directory 
    $image->move(public_path('uploads/products'), $imageName);

    // save image name into database 
    $product->image = $imageName;
    $product->save();
    }
    return redirect()->route('products.index')->with('success','Product created successfully');
      
    }





    // this method will show edit product page 
    public function edit($id){
        $products = Product::findOrFail($id);
      return view('products.edit', compact('products'));
    }




    
    // this method will update a product 
    public function update($id , Request $request){
        $products = Product::findOrFail($id);
        $rule =[
            'name' => 'required|min:5',
            'sku' => 'required|min:5',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
           
            if($request->image !=""){
                $rule['image'] = 'image';
            }
    
          $validator =  Validator::make($request->all(), $rule);
           if($validator->fails()){
              return redirect()->route('products.edit',$products->id)->withInput()->withErrors($validator);
           }
        //  here we will insert product in db
        //  $products = new Product();
        $products->name = $request->name;
        $products->sku = $request->sku;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->save();
        
        if($request->image !=""){
        //  delete old image 
        File::delete(public_path("uploads/products/".$products->image));

         // here we will store image 
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;
    
        // save image to products directory 
        $image->move(public_path('uploads/products'), $imageName);
    
        // save image name into database 
        $products->image = $imageName;
        $products->save();
        }
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }




    // this method will delete a product 
    public function destroy($id){
      $products = Product::findOrFail($id);
      
    //   delete image 
    File::delete(public_path('uploads/products/'.$products->image));

    // delete product from database 
    $products->delete();

    return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
