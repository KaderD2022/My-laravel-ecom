<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Facades\Session;
use  Illuminate\Support\Facades\Hash;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Illuminate\Routing\Redirector;
use  App\Models\Slider;
use  App\Models\Product;
use  App\Models\Cart;
use  App\Models\Client;
use  App\Models\Order;
class ClientController extends Controller
{
    //
    public function home(){ 
        $sliders = Slider::where('status',1)->get(); 
        $products = Product::where('status',1)->get(); 
        return view("client.home")->with('sliders', $sliders)->with('products', $products);   
    }
    
    public function shop(){  
        $products = Product::where('status',1)->get(); 
        return view("client.shop")->with('products', $products);   
    }

    public function cart(){  
        return view("client.cart");   
    }

    public function checkout(){  
        if(Session::has('client')) return view("client.checkout");  
        return redirect('/sign');
    }
    public function account(){  
        return view("client.account");   
    }
    public function sign(){  
        return view("client.sign");   
    }
    public function logout(){  
        Session::forget('client');
        return back();   
    }


    public function createaccount(Request $request){  
        $this->validate($request, [
            'email' =>  'email|required|unique:clients',
            'password' =>  'required|min:4|unique:clients',

        ]);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        $client->save();
        return back()->with('status', 'Your account has been successfully created');  
    }

    public function accessaccount(Request $request){  
        $this->validate($request, [
            'email' =>  'email|required',

        ]);

        $client = Client::where('email', $request->email)->first();
        if ($client){
            if(Hash::check($request->input('password'), $client->password)){
                Session::put('client',$client);
                return redirect("/shop");
            }
            return back()->with('error', 'wrong email or password');
        }
        return back()->with('error', 'You do not have an account with this email');
       

        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        $client->save();
        return back()->with('status', 'Your account has been successfully created');  
    }

    public function addtocart($id){  
        $product = Product::find($id);
        print(json_encode($product));
        // if(!$product){
        //     abort(404);
        // }
        
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        $cart = new Cart($oldCart);
        $cart->add($product);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        //dd(Session::get('cart'));
        return back();
        // return redirect('/gio-hang');
        //return view("client.sign");   
    }
    public function updateqty(Request $request, $id){  

        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->qty);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();


    }
    public function remoteitem(Request $request, $id){  

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();
    }
    public function payer(Request $request){  

        try{

            $oldCart = Session::has('cart') ? Session::get('cart'): null;
            $cart = new Cart($oldCart);
            $order = new Order();
            $order->names = $request->input('firstname')." ".$request->input('lastname');     
            $order->address = $request->input('address');     
            $order->cart = serialize($cart);  

            Session::put('order', $order);

            $checkoutData = $this->checkoutData();

            $provider = new ExpressCheckout();

            $response = $provider->setExpressCheckout($checkoutData);

            return redirect($response['paypal_link']);

        }
        catch(\Exception $e){
            return redirect('/cart')->with('status', $e->getMessage());
        }       

    }

    private function checkoutData(){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $data['items'] = [];

        foreach($cart->items as $item ){
                $itemDetails=[
                'name' => $item['product_name'],
                'price' => $item['product_price'],
                'qty' => $item['qty']
                ];

            $data['items'][] = $itemDetails;            
        }

        $checkoutData = [
            'items' => $data['items'],
            'return_url' => url('/paymentSuccess'),
            'cancel_url' => url('/cart'),
            'invoice_id' => uniqid(),
            'invoice_description' => "order description",
            'total' => Session::get('cart')->totalPrice
        ];

        return $checkoutData;
    }

    public function paymentSuccess(Request $request){

        try{

		    $token = $request->get('token');
        	$payerId = $request->get('PayerID');
        	$checkoutData = $this->checkoutData();

        	$provider = new ExpressCheckout();
        	$response = $provider->getExpressCheckoutDetails($token);
        	$response = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);

            Session::get('order')->save();

            Session::forget('cart');
            Session::forget('topCart');

            return redirect('/cart')->with('status', 'Votre commande a été effectuée avec succès !! ');
        }
        catch(\Exception $e){
            return redirect('/cart')->with('status', $e->getMessage());
        }
    }
}
