<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.navbar');
    }

    public function home(){
        return redirect()->route('user.dashboard');
    }

    public function contactus(){

        return redirect()->route('user.cont');
    }

    public function about()
    {
        return redirect()->route('user.about');
        
    }

    public function services()
    {
        return redirect()->route('user.services');
        
    }
}
