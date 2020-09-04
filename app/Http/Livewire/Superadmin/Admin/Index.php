<?php

namespace App\Http\Livewire\Superadmin\Admin;

use App\User;
use Livewire\Component;
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
        'adminStored' => 'handleStored',
        'adminUpdate' => 'handleUpdated',
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
        return view('livewire.superadmin.admin.index', [
            'admins' => 
                User::search($this->search)->Role('admin')->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->latest()->paginate($this->paginate) ]);
    }

    public function handleStored($admin){
        // session()->flash('admin', 'Berhasil menambahkan Admin ' . $admin['name']);
    }

    public function handleUpdated($admin){
        // session()->flash('admin', 'Berhasil mengubah Admin ' . $admin['name']);
    }

    public function getAdmin($id){
        $this->statusUpdate = true;
        $admin = User::find($id);
        $this->emit('getAdmin', $admin);
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        $name = $admin->name;
        User::destroy($id);

        session()->flash('admin', 'Berhasil menghapus Admin ' . $name);
    }

    
}
