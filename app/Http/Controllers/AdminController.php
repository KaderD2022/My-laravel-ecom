<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Category;
use  App\Models\Slider;
use  App\Models\Product;
use  App\Models\Order;
class AdminController extends Controller
{
    //
    public function admin(){  
        return view("admin.home");   
    }

    public function addcategory(){  
        return view("admin.addcategory");   
    }

    public function addproduct(){  
        $categories = Category::get();
        return view("admin.addproduct")->with('categories', $categories);  
    }

    public function addslider(){  
        return view("admin.addslider");   
    }

    public function category(){  

        $categories = Category::get();
        return view("admin.categories")->with('categories', $categories);    
    } 

    public function orders(){ 
        $orders = Order::All();
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view("admin.orders")->with('orders', $orders);   
    }

    public function product(){ 
        $products = Product::get(); 
        return view("admin.product")->with('products',  $products);  
    }

    public function slider(){  
        $sliders = Slider::get();
        return view("admin.slider")->with('sliders', $sliders);   
    }



}
  