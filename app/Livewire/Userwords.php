<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Userword;
use App\Models\Word;
use Livewire\Component;

class Userwords extends Component
{
    public function render()
    {
        return view('livewire.userwords');
    }
}
