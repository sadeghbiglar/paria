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
    public $EditingID='';
   // #[Rule('required|min:2|max:50')]
    //public $EditingName='';

    public function mount(){
        $this->roles=\App\Models\Roles::all();

    }
    public  function createNewUser(){
        
       // $this->validate();
        // dd($validated);
       /*  $this->validateOnly('email');
        $this->validateOnly('name');
        $this->validateOnly('role_id');
        $this->validateOnly('password'); */
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
    public function delete($userID){
    User::find($userID)->delete();
    }
    public  function edit($userID){
        $this->EditingID=$userID;
        $this->EditingName=User::find($userID)->name;
        $this->openEditUserModal();
    }
    public  function cancelEdit(){
    $this->reset('EditingID','EditingName');
    $this->closeEditUserModal();
    }
    public function update(){
        $this->validateOnly('EditingName');
        User::find($this->EditingID)->update(
            [
                'name'=>$this->EditingName
            ]
        );
        $this->cancelEdit();
        $this->closeEditUserModal();
    }
    public $showCreateUserModal = false;
    public $showEditUserModal = false;

    public function openCreateUserModal()
    {
        $this->showCreateUserModal = true;
    }
    public function closeCreateUserModal()
    {
        $this->showCreateUserModal = false;
    }
    public function openEditUserModal()
    {
        $this->showEditUserModal = true;
    }
    public function closeEditUserModal()
    {
        $this->showEditUserModal = false;
    }
    public function render()
    {
        return view('livewire.users',[
            'users'=>User::latest()->where('name','like',"%{$this->search}%")->paginate(3)]);
    }
}
