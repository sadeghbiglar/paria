<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateUser extends Component
{


    #[Rule('required|min:2|max:50')]
    public $name='';
    #[Rule('required|email|unique:users')]
    public $email='';
    #[Rule('required|min:5')]
    public $password='';
    #[Rule('required')]
    public $role_id='';
    public $roles='';
    #[Rule('required|same:password')]
    public $password_confirmation = '';
    public function mount(){
        $this->roles=\App\Models\Roles::all();
    }
    public  function createUser(){

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
        request()->session()->flash('success', 'کاربر با موفقیت اضافه شد');
        $this->dispatch('close-modal',name:'new-user');
    }
    public function render()
    {
        return view('livewire.create-user');
    }
}
