<?php
namespace App\Http\Livewire\User;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product, $openmodal = false;
    public $productId, $qty;

    protected $listeners = ['addToCart', 'cartUpdated' => '$refresh'];

    public function mount($id)
    {
        $this->product = Product::find($id);
    }

    // public function addToCart($id, $quantity)
    // {
    //     $this->openmodal = true;
    //     $this->productId = $id;
    //     $this->qty = (int) $quantity;
    //     $this->savecart();
    // }

    // public function savecart()
    // {
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$this->productId])) {
    //         $cart[$this->productId]['qty'] += $this->qty;
    //     } else {
    //         $product = Product::find($this->productId);
    //         if ($product) {
    //             $cart[$this->productId] = [
    //                 'id' => $product->id,
    //                 'name' => $product->name,
    //                 'price' => $product->price,
    //                 'image' => $product->image,
    //                 'qty' => $this->qty,
    //             ];
    //         }
    //     }

    //     session()->put('cart', $cart);
    //     $this->emit('cartUpdated');
    // }
    public function addToCart($id)
    {
        $product = Product::find($id);
        // dd($product);

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

    // public function increaseQuantity($id)
    // {
    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id])) {
    //         $cart[$id]['qty'] += 1;
    //         session()->put('cart', $cart);
    //     }
    //     $this->emit('cartUpdated');
    // }

    // public function decreaseQuantity($id)
    // {
    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id]) && $cart[$id]['qty'] > 1) {
    //         $cart[$id]['qty'] -= 1;
    //         session()->put('cart', $cart);
    //     }
    //     $this->emit('cartUpdated');
    // }

    // public function removeItem($id)
    // {
    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
    //         session()->put('cart', $cart);
    //     }
    //     $this->emit('cartUpdated');
    // }

    public function closemodal()
    {
        $this->openmodal = false;
    }

    public function checkout()
    {
        return redirect()->route('user.checkout');
    }

    public function render()
    {
        $cart = session()->get('cart', []);
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return view('livewire.user.product-details', [
            'product' => $this->product,
            'cartitem' => $cart,
            'totalPrice' => $totalPrice,
        ])->layout('layouts.master');
    }
}

