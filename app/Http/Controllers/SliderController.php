<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use  App\Models\Slider;
class SliderController extends Controller
{
    //

    public function saveslider(Request $request){
        $this->validate($request, [
            'description1' =>  'required',
            'description2' =>  'required',
            'image' =>  'image|nullable|max:1999',

        ]);
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);


        $ext = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $fileName."_".time().".".$ext;

        $path = $request->file('image')->storeAs("public/slider_images", $fileNameToStore);


        //print($request->file('image')->getClientOriginalName());

        $slider = new Slider();
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->image = $fileNameToStore;
        $slider->save();
        return back()-> with('status','Le slider a éte ajoutée avec success  Category Added Successfully!');

    }

    public function deleteslider($id){ 
        $slider = Slider::find($id);
        Storage::delete("public/slider_images/{$slider->image}");
        $slider->delete();

        return redirect('/admin/slider')->with('status', 'Le slider  a bien été supprime !');   
    }


    public function editslider($id){ 
        $slider = Slider::find($id);
 
        return view("admin.editslider")->with('slider', $slider);

    }


    public function updateslider($id,Request $request){ 

        $slider = Slider::find($id);
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        

        if ($request->file('image')) {
            # code...
            $this->validate($request, [

                'image' =>  'image|nullable|max:1999',
                

            ]);
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);


            $ext = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName."_".time().".".$ext;

            Storage::delete("public/slider_images/{$slider->image}");
            $path = $request->file('image')->storeAs("public/slider_images", $fileNameToStore);
            $slider->image = $fileNameToStore;
        }
        $slider->update();

        return redirect('/admin/slider')->with('status', 'Le slider  a bien été mis a jour !'); 
    }

    public function unactivateslider($id){ 
        $slider = Slider::find($id);

        $slider->status=0;

        $slider->update();

 
        return back();


    }


    public function activateslider($id){ 
        $slider = Slider::find($id);

        $slider->status=1;

        $slider->update();

 
        return back();

    }



}
