<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\Category;
class CategoryController extends Controller
{
    //
    public function savecategory(Request $request){
        $this->validate($request, [
            'category_name' =>  'required',

        ]);
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();
        return back()-> with('status','La category a éte ajoutée avec success  Category Added Successfully!');


    }

    public function editcategory($id){ 
        $category = Category::find($id);
 
        return view("admin.editcategory")->with('category', $category);

    }


    public function updatecategory($id,Request $request){ 

        // $this->validate($request, [
        //     'category_name' =>  'required',
        // ]);
        $category = Category::find($id);
        $category->category_name= $request->input('category_name');
        $category->update();


        // $data = array();
        // $data['category_name']= $request->input('category_name');

        // DB::table('category')->where('id', $id)->update($data);
        return redirect('admin/category')->with('status', 'Le produit  a bien été mis a jour !'); 
    }
    public function deletecategory($id){ 
        $category = Category::find($id);
        $category->delete();

        // DB::table('$category')->where("id", $id)->delete();


        return redirect('/admin/category')->with('status', 'Le produit  a bien été supprime !');   
    }




    
}
