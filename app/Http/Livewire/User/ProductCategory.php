<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Http\Livewire\Admin\Category;
use App\Models\Cart;
use App\Models\Category as ProductCate;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Auth;
class ProductCategory extends Component
{
    public $openmodal = false;

    public $productId, $qty, $cat_id ;

    public function mount($id)
    {
        $this->cat_id = $id; // Set route ID to `cat_id`
    }


    public function buyNow($id){
        dd($id);
    }

    public function productdetails($id)
    {
        return redirect()->route('user.productdetails', ['id' => $id]);
    }

    public function checkout()
    {
        return redirect()->route('user.checkout');
    }



    public function increaseQuantity($id){
        
                // dd($id);
                if($id){
                    $userId = Auth::guard('user')->user()->id;
            
                    // Check if product already exists in cart
                    $cart = Cart::where('user_id', $userId)
                    ->where('id', $id) // ✅ Correct: `id` se filter karein
                    ->first();
        
                                if ($cart) {
                                    // If product exists, increase quantity
                                    $cart->qty += 1;
                                    $cart->save();
                }
        
                
        
        
            }
    }

    public function decreaseQuantity($id)
    {
        if ($id) {
            $userId = Auth::guard('user')->user()->id;
    
            $cart = Cart::where('user_id', $userId)
                        ->where('id', $id)
                        ->first();
    
            if ($cart && $cart->qty > 1) {
                $cart->qty -= 1;
                $cart->save();
            }
        }
    }

    public function removeItem($id)
    {
        if ($id) {
            $userId = Auth::guard('user')->user()->id;
    
            $cart = Cart::where('user_id', $userId)
                        ->where('id', $id)
                        ->first();
                        if($cart){
                            $cart->delete();   
                        }
    

        }
    }


    public function addToCart($id){
        $this->openmodal();
        $this->productId = $id;
        $this->savecart();
    }

    public function savecart()
    {
        if ($this->productId) {
            $userId = Auth::guard('user')->user()->id;
    
            // Check if product already exists in cart
            $cart = Cart::where('user_id', $userId)
                        ->where('product_id', $this->productId)
                        ->first();
    
            if ($cart) {
                // If product exists, increase quantity
                $cart->qty += 1;
                $cart->save();
            } else {
                // dd($userId);
                // If product does not exist, create a new cart entry
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $this->productId,
                    'qty' => 1, // Default quantity
                ]);
            }
        }
    }
    

    public function openmodal(){
        $this->openmodal = true;
    }

    public function closemodal(){
        $this->openmodal = false;
    }

    public function render()
    {
        $products = ProductModel::all();
        $categories = ProductCate::where('id', $this->cat_id)->with('getproduct')->get();
        // dd($categories);
        $carts = Cart::where('user_id',Auth::guard('user')->user()->id)->with('getproduct')->get();
        $totalPrice = $carts->sum(function ($cart) {
            return $cart->getproduct ? $cart->getproduct->price * $cart->qty : 0;
        });
    
        return view('livewire.user.product-category', compact('products','carts','totalPrice','categories'))->layout('layouts.master');
    }

}
