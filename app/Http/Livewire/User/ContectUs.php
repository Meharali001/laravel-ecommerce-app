<?php

namespace App\Http\Livewire\User;

use App\Models\category;
use Livewire\Component;

class ContectUs extends Component
{
    public function render()
    {
        $categories = category::all();
        return view('livewire.user.contect-us', compact('categories'))->layout('layouts.master');
    }
}
