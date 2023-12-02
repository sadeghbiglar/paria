<?php

namespace App\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;

class EditUser extends Component
{
    public $id;
    public $roles = '';
    #[Rule('required')]
    public $role_id = '';
    #[Rule('required|min:6|max:50')]
    public $name = '';
    #[Rule('sometimes|min:8')]
    public $password = '';
    //#[Rule('required|email|unique:users')]
    public $email = '';
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email,'.$this->id.',id',
        ];
    }
    public function updateUser()
    {
        $validatedData=$this->validate();
        if($this->password=='')
        {
                User::find($this->id)->update([
                    'name'=>$validatedData['name'],
                    'email' => $validatedData['email'],
                    'role_id' => $validatedData['role_id'],
                ]);
        }
        else{

            User::find($this->id)->update([
                'name'=>$validatedData['name'],
                'email' => $validatedData['email'],
                'role_id' => $validatedData['role_id'],
                'password' => Hash::make($validatedData['password'])
            ]);
        }

        $this->reset(['id','name', 'email', 'password', 'role_id']);

        request()->session()->flash('success', 'کاربر با موفقیت ویرایش شد');
        $this->dispatch('close-modal', name: 'edit-user');

    }
    public function mount(User $selectedUser)
    {

        $this->id=$selectedUser->id;
        $this->name = $selectedUser->name;
        $this->email = $selectedUser->email;
        $this->role_id = $selectedUser->role_id;
        $this->roles = \App\Models\Roles::all();

    }

    public function render()
    {
        return view('livewire.edit-user');
    }
}
