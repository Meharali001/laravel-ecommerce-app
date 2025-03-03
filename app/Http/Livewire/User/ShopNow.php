<?php

namespace App\Http\Livewire\User;

use App\Models\Product as ProductModel;
use App\Models\Category as ProductCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShopNow extends Component
{
    public $openmodal = false;
    public $productId, $qty;

    public function buyNow($id)
    {
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

    public function addToCart($id)
    {
        $product = ProductModel::find($id);

        if (!$product) {
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "qty" => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->openmodal = true;
    }

    public function increaseQuantity($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
            session()->put('cart', $cart);
        }
    }

    public function decreaseQuantity($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id]) && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty'] -= 1;
            session()->put('cart', $cart);
        }
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    }

    public function openmodal()
    {
        $this->openmodal = true;
    }

    public function closemodal()
    {
        $this->openmodal = false;
    }

    public function render()
    {
        $products = ProductModel::all();
        $categories = ProductCategory::with('getproduct')->get();
        $cart = session()->get('cart', []);

        $totalPrice = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        return view('livewire.user.shop-now', compact('products', 'categories', 'cart', 'totalPrice'))
            ->layout('layouts.master');
    }
}
