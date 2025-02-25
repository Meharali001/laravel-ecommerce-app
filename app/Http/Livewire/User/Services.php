<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.user.services')->layout('layouts.master');
    }
}
