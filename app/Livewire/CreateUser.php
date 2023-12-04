<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Userword;
use App\Models\Word;
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
    public $lesson1_words='';
    public function mount(){
        $this->roles=\App\Models\Roles::all();
        $this->lesson1_words=\App\Models\Word::all();
    }
    public  function createUser(){

        $validated=$this->validate();
      $user=  User::create(

            [
                'name'=>$validated['name'],
                'email'=>$validated['email'],
                'password'=>Hash::make( $validated['password']),
                'role_id'=>$validated['role_id']
            ]);
        $lesson1_words = Word::take(3)->get();
       foreach ($lesson1_words as $word) {
           Userword::create([
               'user_id' => $user->id,
               'word_id' => $word->id,
           ]);
       }


        $this->reset(['name','email','password','role_id']);
        request()->session()->flash('success', 'کاربر با موفقیت اضافه شد');
        $this->dispatch('close-modal',name:'new-user');
    }
    public function render()
    {
        return view('livewire.create-user');
    }
}
