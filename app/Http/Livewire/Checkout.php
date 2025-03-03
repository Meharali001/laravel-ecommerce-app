<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    // public $totalPrice;
    public $stripeToken; // Livewire property for token
    public $card_number, $exp_month, $exp_year, $cvc, $totalPrice;
    protected $listeners = ['processPayment'];

    // public function removeItem($id)
    // {

    //     // dd($id);
    //     if ($id) {
    //         $userId = Auth::guard('user')->user()->id;
    //         $orderdetail = OrderDetail::where('user_id', $userId)->where('id', $id)->first();
    //         if ($orderdetail) {
    //             $orderdetail->delete();
    //             $this->emit('toastr', ['type' => 'success', 'message' => 'Item removed successfully!']);
    //             return redirect()->route('user.checkout');
    //         }
    //     }
    // }

    public function removeItem($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            $this->emit('toastr', ['type' => 'success', 'message' => 'Item removed successfully!']);
        }
        
    }

    public function processPayment($token)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
    
            $userId = Auth::guard('user')->user()->id;
    
            DB::beginTransaction(); // Start Transaction
    
            // Pehle cart ko OrderDetail main save karein
            $this->storeCartToOrderDetails();
    
            // OrderDetail se cart items lana
            $orderdetail = OrderDetail::where('user_id', $userId)
                ->where('order_done', '0')
                ->with('getproduct')
                ->get();
    
            $total = $orderdetail->sum(fn($cart) => $cart->getproduct ? $cart->getproduct->price * $cart->qty : 0);
    
            if ($total <= 0) {
                throw new \Exception('Cart is empty. Please add items before proceeding.');
            }
    
            // Stripe Payment
            $charge = Charge::create([
                'amount' => $total * 100,
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Laravel Stripe Payment',
                'capture' => true,
            ]);
    
            if ($charge) {
                $order = Order::create([
                    'user_id' => $userId,
                    'charge_id' => $charge->id,
                    'total_amount' => $total,
                ]);
    
                foreach ($orderdetail as $cart) {
                    $cart->update(['order_done' => '1', 'order_id' => $order->id]);
                }
    
                DB::commit(); // Transaction Commit
    
                session()->forget('cart'); // Sirf successful payment ke baad session clear karein
                $this->emit('toastr', ['type' => 'success', 'message' => 'Payment Successful!']);
                return redirect()->route('user.Thanks-page', $order->id);
            }
    
        } catch (\Exception $e) {
            DB::rollBack(); // Koi error aaye to rollback
            $this->emit('toastr', ['type' => 'error', 'message' => 'Payment Failed: ' . $e->getMessage()]);
        }
    }
    
    public function storeCartToOrderDetails()
    {
        $userId = Auth::guard('user')->user()->id;
        $cart = session()->get('cart', []);
    
        if (!empty($cart)) {
            foreach ($cart as $item) {
                OrderDetail::updateOrCreate(
                    ['user_id' => $userId, 'product_id' => $item['id'], 'order_done' => '0'], 
                    ['qty' => $item['qty'], 'price' => $item['price']]
                );
            }
        }
    }

    public function addToCart($productId)
{
    $product = product::find($productId);
    $cart = session()->get('cart', []);

    // Product agar already cart me ho to quantity increase karein
    if (isset($cart[$productId])) {
        $cart[$productId]['qty'] += 1;
    } else {
        // Product add karein session cart me
        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'color' => $product->color,
            'price' => $product->price,
            'qty' => 1
        ];
    }

    session()->put('cart', $cart);
}


    
    
    
    

    
    
    

public function render()
{
    $cart = session()->get('cart', []);

    $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

    return view('livewire.checkout', [
        'totalPrice' => $totalPrice,
        'cartitem' => $cart,
    ])->layout('layouts.master');
}


}
