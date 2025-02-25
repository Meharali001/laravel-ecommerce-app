<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Stripe;

class Checkout extends Component
{
    // public $totalPrice;
    public $stripeToken; // Livewire property for token
    public $card_number, $exp_month, $exp_year, $cvc, $totalPrice;
    protected $listeners = ['processPayment'];

    public function removeItem($id)
    {

        // dd($id);
        if ($id) {
            $userId = Auth::guard('user')->user()->id;
            $cart = Cart::where('user_id', $userId)->where('id', $id)->first();
            if ($cart) {
                $cart->delete();
                $this->emit('toastr', ['type' => 'success', 'message' => 'Item removed successfully!']);
                return redirect()->route('user.checkout');
            }
        }
    }

    public function processPayment($token)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $userId = Auth::guard('user')->user()->id;
            $cartitem = Cart::where('user_id', $userId)->with('getproduct')->get();
            $total = $cartitem->sum(fn($cart) => $cart->getproduct ? $cart->getproduct->price * $cart->qty : 0);

            $charge = Charge::create([
                'amount' => $total * 100,
                'currency' => 'usd',
                'source' => $token, // Use the generated token here
                'description' => 'Laravel Stripe Payment',
                'capture' => true,
            ]);

            $this->emit('toastr', ['type' => 'success', 'message' => 'Payment Successful!']);

        } catch (\Exception $e) {
            $this->emit('toastr', ['type' => 'error', 'message' => 'Payment Failed: ' . $e->getMessage()]);
        }
    }
    
    
    

    
    
    

    public function render()
    {
        $userId = Auth::guard('user')->user()->id;
        $cartitem = Cart::where('user_id', $userId)->with('getproduct')->get();
        $this->totalPrice = $cartitem->sum(fn($cart) => $cart->getproduct ? $cart->getproduct->price * $cart->qty : 0);

        // dd($this->totalPrice);

        return view('livewire.checkout', [
            'totalPrice' => $this->totalPrice,
            'cartitem' => $cartitem,
        ])->layout('layouts.master');
    }
}
