<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $role_id = '';
    public $search = '';

    public function render()
    {
       // $users=User::latest()->where('name','like',"%{{$this->search}}%")->paginate(3);
        return view('livewire.users',[
            'users'=>User::latest()->where('name','like',"%{$this->search}%")->paginate(3)]);
    }
}
