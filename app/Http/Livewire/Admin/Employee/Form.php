<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\Employee;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $gender;
    public $employeeId;

    public $statusUpdate;

    protected $listeners = [
        'getEmployee' => 'showEmployee'
      ];

    public function render()
    {
        return view('livewire.admin.employee.form');
    }

    public function storeEmployee(){
        $this->resetInput();
        $this->statusUpdate = false;
    }

    public function showEmployee($employee){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->name = $employee['name'];
        $this->email = $employee['email'];
        $this->phone = $employee['phone'];
        $this->address = $employee['address'];
        $this->gender = $employee['gender'];
        $this->employeeId = $employee['id'];

        $this->statusUpdate = true;
    }

    public function store(){
        
        $this->validate($this->validateRule(), $this->messagesValidate(), $this->customAttributes());
        
        $employee = Employee::create($this->data());

        $this->resetInput();
        $this->emit('employeeStored', $employee);
        $this->emit('alert', ['message' => 'Berhasil menambah pegawai ' . $employee->name]);

    }

    public function update(){
        $this->validate([
            'name' => ['required', 'max:30'],
            'email' => ['required'],
            'phone' => ['required', 'max:15'],
            'address' => ['required'],
            'gender' => ['required'],
        ], $this->messagesValidate(), $this->customAttributes());

        $employee = Employee::find($this->employeeId);

        $employee->update($this->data());
        $this->resetInput();

        $this->emit('alert', ['message' => 'Berhasil mengubah pegawai ' . $employee->name]);
        $this->emit('employeeUpdated', $employee);

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

    public function validateRule(){
        return [
            'name' => ['required', 'max:30'],
            'email' => ['required', 'unique:employees,email'],
            'phone' => ['required', 'max:15'],
            'address' => ['required'],
            'gender' => ['required'],
        ];
    }

    public function data(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ];
    }
}
