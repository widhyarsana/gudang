<?php

namespace App\Http\Livewire\Admin\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $confirming;
    public $statusUpdate = false;
    public $paginate = 5;
    public $search = '';
    public $sortField = 'created_at';
    public $sortAsc = true;

    protected $listeners = [
        'employeeStored' => 'handleStored',
        'employeeUpdated' => 'handleUpdated',
    ];

    protected $updatesQueryString = ['search'];

    public function mount(){
        $this->search = request()->query('search', $this->search);

    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.admin.employee.index', [
            'employees' => 
                Employee::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->latest()->paginate($this->paginate) ]);
    }

    public function handleStored($employee){
        // session()->flash('employee', 'Berhasil menambahkan Pegawai ' . $employee['name']);
    }

    public function handleUpdated($employee){
        // session()->flash('employee', 'Berhasil mengubah Pegawai ' . $employee['name']);
    }

    public function getEmployee($id){
        
        $this->statusUpdate = true;
        $employee = employee::find($id);
        $this->emit('getEmployee', $employee);
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function destroy($id)
    {
        $employee = employee::find($id);
        $name = $employee->name;
        Employee::destroy($id);

        session()->flash('employee', 'Berhasil menghapus Pegawai ' . $name);
    }
}
