<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetails extends Component
{
    public $cart, $product, $openmodal = false, $productqty;
    public $productId, $qty;

    protected $listeners = ['addToCart'];

    public function mount($id)
    {
        if ($id) {
            $userId = Auth::guard('user')->user()->id;
            $this->cart = Cart::with('getproduct')
                ->where('user_id', $userId)
                ->where('product_id', $id)
                ->first();
            $this->product = Product::find($id);
        }
    }

    public function addToCart($id, $quantity)
    {
        
        $this->openmodal = true; 
        $this->productId = $id;
        $this->qty = (int)$quantity; // ✅ Quantity set hogi

        // ✅ Debugging ke liye session message use karein (dd hata dein)
        session()->flash('message', "Product ID: $id, Quantity: $quantity");

        // ✅ Cart save logic
        $this->savecart();
    }

    public function savecart()
    {
        if ($this->productId) {
            $userId = Auth::guard('user')->user()->id;

            $cart = Cart::where('user_id', $userId)
                ->where('product_id', $this->productId)
                ->first();

            if ($cart) {
                $cart->qty += $this->qty;
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $this->productId,
                    'qty' => $this->qty, // ✅ User entered quantity
                ]);
            }
        }
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

    public function checkout()
    {
        return redirect()->route('user.checkout');
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

    public function closemodal(){
        $this->openmodal = false;
    }

    public function render()
    {
        $cartitem = Cart::where('user_id', Auth::guard('user')->user()->id)
            ->with('getproduct')->get();

        $totalPrice = $cartitem->sum(fn($cart) => $cart->getproduct ? $cart->getproduct->price * $cart->qty : 0);

        return view('livewire.user.product-details', [
            'cart' => $this->cart,
            'product' => $this->product,
            'cartitem' => $cartitem,
            'totalPrice' => $totalPrice,
        ])->layout('layouts.master');
    }
}
