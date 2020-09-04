<?php

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $email;
    public $phone;
    public $role;
    public $address;
    public $gender;
    public $partnerId;

    public $statusUpdate;

    protected $listeners = [
        'getPartner' => 'showPartner'
      ];

    public function render()
    {
        return view('livewire.admin.partner.form');
    }

    public function storePartner(){
        $this->resetInput();
        $this->statusUpdate = false;
    }

    public function showPartner($partner){

        $this->resetErrorBag();
        $this->resetValidation();

        $role = Partner::find($partner['id']);

        $this->name = $partner['name'];
        $this->email = $partner['email'];
        $this->phone = $partner['phone'];
        $this->address = $partner['address'];
        $this->gender = $partner['gender'];
        $this->role = $role->getRoleNames()[0];
        $this->partnerId = $partner['id'];

        $this->statusUpdate = true;
    }

    public function store(){
        
        $this->validate($this->validateRule(), $this->messagesValidate(), $this->customAttributes());
        
        $partner = Partner::create($this->data());
        $partner->assignRole($this->role);

        $this->resetInput();
        $this->emit('partnerStored', $partner);
        $this->emit('alert', ['message' => 'Berhasil menambah mitra ' . $partner->name]);

    }

    public function update(){
        $this->validate([
            'name' => ['required', 'max:30'],
            'role' => ['required'],
            'email' => ['required'],
            'phone' => ['required', 'max:15'],
            'address' => ['required'],
            'gender' => ['required'],
        ], $this->messagesValidate(), $this->customAttributes());

        $partner = Partner::find($this->partnerId);

        $partner->update($this->data());
        $role = $partner->getRoleNames()[0];

        if($this->role != $partner->getRoleNames()[0]){
            $partner->removeRole($role);
            $partner->assignRole($this->role);
        }
        $this->resetInput();

        $this->emit('partnerUpdated', $partner);
        $this->emit('alert', ['message' => 'Berhasil mengubah mitra ' . $partner->name]);

    }

    public function resetInput(){
        $this->name = '';
        $this->role = '';
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

    public function validateRule(){
        return [
            'name' => ['required', 'max:30'],
            'role' => ['required'],
            'email' => ['required', 'unique:partners,email'],
            'phone' => ['required', 'max:15'],
            'address' => ['required'],
            'gender' => ['required'],
        ];
    }

    public function data(){
        return $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ];
    }

}
