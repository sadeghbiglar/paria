<?php

namespace App\Livewire;
use App\Models\Roles;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $roles='';
    public User $selectedUser;
    public function mount(){
        $this->roles=\App\Models\Roles::all();
    }
    public function editUser(User $user){
        $this->selectedUser=$user;
        $this->dispatch('open-modal',name:'edit-user');
    }


    public function delete($userID){
    User::find($userID)->delete();
    }

    public function render()
    {
        return view('livewire.users',[
            'users'=>User::latest()->where('name','like',"%{$this->search}%")->paginate(3)]);
    }
}
