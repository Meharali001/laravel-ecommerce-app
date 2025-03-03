<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\Category as ProductCate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductCategory extends Component
{
    public $openmodal = false;
    public $productId, $qty, $cat_id;

    public function mount($id)
    {
        $this->cat_id = $id; // Set route ID to `cat_id`
    }

    public function closemodal(){
        $this->openmodal = false;
    }

    public function productdetails($id)
    {
        return redirect()->route('user.productdetails', ['id' => $id]);
    }

    public function addToCart($id)
    {
        $this->productId = $id;
        $this->saveCart();
        $this->openmodal = true;
    }

    public function saveCart()
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$this->productId])) {
            // Agar product already cart mein hai to qty increase karein
            $cart[$this->productId]['qty'] += 1;
        } else {
            // Naya product add karein
            $product = ProductModel::find($this->productId);
            if ($product) {
                $cart[$this->productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => 1,
                    'image' => $product->image
                ];
            }
        }

        Session::put('cart', $cart);
    }

    public function increaseQuantity($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
            Session::put('cart', $cart);
        }
    }

    public function decreaseQuantity($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id]) && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty'] -= 1;
            Session::put('cart', $cart);
        }
    }

    public function removeItem($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
    }

    public function checkout()
    {
        return redirect()->route('user.checkout');
    }

    public function render()
    {
        $products = ProductModel::all();
        $categories = ProductCate::where('id', $this->cat_id)->with('getproduct')->get();

        $cart = Session::get('cart', []);
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['qty'];
        }, $cart));

        return view('livewire.user.product-category', compact('products', 'cart', 'totalPrice', 'categories'))->layout('layouts.master');
    }
}
