<?php

namespace App\Http\Livewire\Superadmin\Admin;

use App\User;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $username;
    public $password;
    public $email;
    public $phone;
    public $address;
    public $gender;
    public $adminId;

    public $statusUpdate;

    protected $listeners = [
        'getAdmin' => 'showAdmin'
      ];

    public function render()
    {
        return view('livewire.superadmin.admin.form');
    }

    public function storeAdmin(){
        $this->resetInput();
        $this->statusUpdate = false;
    }

    public function showAdmin($admin){
        
        $this->resetErrorBag();
        $this->resetValidation();

        $this->name = $admin['name'];
        $this->username = $admin['username'];
        $this->email = $admin['email'];
        $this->phone = $admin['phone'];
        $this->address = $admin['address'];
        $this->gender = $admin['gender'];
        $this->adminId = $admin['id'];

        $this->statusUpdate = true;
    }

    public function store(){
        
        $this->validate([
            'name' => ['required', 'max:30'],
            'username' => ['required', 'max:15', 'min:4', 'unique:users,username'],
            'password' => ['required', 'min:6',],
            'email' => ['required', 'unique:users,email'],
            'phone' => ['required', 'max:15'],
            'address' => ['required'],
            'gender' => ['required'],
        ], $this->messagesValidate(), $this->customAttributes());

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ];

        $admin = User::create($data);
        $admin->assignRole('admin');

        $this->resetInput();

        $this->emit('adminStored', $admin);
        $this->emit('alert', ['message' => 'Berhasil menambah admin ' . $admin->name]);

    }

    public function update(){
        $this->validate([
            'name' => ['required', 'max:30'],
            'username' => ['required', 'max:15', 'min:4'],
            'email' => ['required'],
            'phone' => ['required', 'max:15'],
            'address' => ['required'],
            'gender' => ['required'],
        ], $this->messagesValidate(), $this->customAttributes());

        $admin = User::find($this->adminId);

        if($this->password == ''){
            $this->password = $admin->password;
        }

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ];

        $admin->update($data);

        $this->resetInput();

        $this->emit('adminUpdate', $admin);
        $this->emit('alert', ['message' => 'Berhasil mengubah admin ' . $admin->name]);

    }

    public function resetInput(){
        $this->name = '';
        $this->username = '';
        $this->password = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->gender = '';
    }

    // Atribut Kustom untuk message
    public function customAttributes(){
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'phone' => 'No. HP',
            'address' => 'Alamat',
            'gender' => 'Jenis Kelamin'
        ];
    }

    public function messagesValidate(){
        return  [
            'required' => ' :attribute tidak boleh kosong.',
            'unique' => ' :attribute telah digunakan.',
            'max' => ' :attribute tidak boleh lebih dari :max karakter.',
            'min' => ' :attribute tidak boleh kurang dari :min karakter.',
        ];
    }
    
}
