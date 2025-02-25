<?php

namespace App\Http\Livewire\User;

use App\Models\SiteBanner;
use App\Models\Testimonial;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function logout()
    {
        // dd('livewire');

        
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }



    public function render()
    {
       $banners = SiteBanner::all();
       $testis = Testimonial::all();
        return view('livewire.user.dashboard',compact('banners','testis'))->layout('layouts.master');
    }
}
