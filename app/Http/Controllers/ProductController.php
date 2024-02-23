<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use  App\Models\Product;
class ProductController extends Controller
{
    //

        public function saveproduct(Request $request){
        $this->validate($request, [
            'product_name' =>  'required',
            'product_price' =>  'required',
            'product_category' =>  'required',
            'product_image' =>  'image|nullable|max:1999',

        ]);
        $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $fileName."_".time().".".$ext;
        $path = $request->file('product_image')->storeAs("public/product_images", $fileNameToStore);


        $product = new product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->product_image = $fileNameToStore;
        $product->save();
        return back()-> with('status','Le product a éte ajoutée avec success  Category Added Successfully!');

    }

    public function deleteproduct($id){ 
        $product = product::find($id);
        Storage::delete("public/product_images/{$product->product_image}");
        $product->delete();

        return redirect('/admin/product')->with('status', 'Le product  a bien été supprime !');   
    }


    public function editproduct($id){ 
        $product = product::find($id);
 
        return view("admin.editproduct")->with('product', $product);

    }


    public function updateproduct($id,Request $request){ 

        $product = product::find($id);
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        //$product->product_category = $request->input('product_category');

        if ($request->file('image')) {
            # code...
        $this->validate($request, [

            'product_image' =>  'image|nullable|max:1999',

        ]);
        $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $fileName."_".time().".".$ext;
        $path = $request->file('product_image')->storeAs("public/product_images", $fileNameToStore);

        }
        $product->update();

        return redirect('/admin/product')->with('status', 'Le product  a bien été mis a jour !'); 
    }

    public function unactivateproduct($id){ 
        $product = Product::find($id);

        $product->status=0;

        $product->update();

 
        return back();


    }


    public function activateproduct($id){ 
        $product = Product::find($id);

        $product->status=1;

        $product->update();

 
        return back();

    }

}
