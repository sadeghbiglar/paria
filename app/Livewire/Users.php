<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    #[Rule('required|min:2|max:50')]
    public $name='';
    #[Rule('required|email|unique:users')]
    public $email='';
    #[Rule('required|min:5')]
    public $password='';
    #[Rule('required')]
    public $role_id='';
    public $search = '';
    public $roles='';
    public function mount(){
        $this->roles=\App\Models\Roles::all();

    }
    public  function createNewUser(){
        $validated=$this->validate();
        User::create(

            [
                'name'=>$validated['name'],
                'email'=>$validated['email'],
                'password'=>Hash::make( $validated['password']),
                'role_id'=>$validated['role_id']
            ]
        );
        $this->reset(['name','email','password','role_id']);
        request()->session()->flash('success','user created success');
    }
    public function render()
    {
        return view('livewire.users',[
            'users'=>User::latest()->where('name','like',"%{$this->search}%")->paginate(3)]);
    }
}
