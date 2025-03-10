<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function render()
    {
        $orders = Order::with('orderDetails')->get();
        $orderdet = OrderDetail::with('getOrder','getproduct')->get();
        // dd($order);
        $totalearn = 0 ;
        $weekly = 0;
        foreach ($orders as $item){
            $totalearn += $item->total_amount;
        }

        $thisweek = Order::where('created_at', '>=', Carbon::now()->subWeek())->get();
        // dd($thisweek);

        foreach ($thisweek as $item){
            $weekly += $item->total_amount;
        }

        

        return view('livewire.admin.dashboard', compact('orders', 'orderdet','totalearn','weekly'));
    }
}
