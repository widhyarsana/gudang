<?php

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
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
        'partnerStored' => 'handleStored',
        'partnerUpdated' => 'handleUpdated',
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
        return view('livewire.admin.partner.index', [
            'partners' => 
                Partner::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->latest()->paginate($this->paginate) ]);
    }

    public function handleStored($partner){
        // session()->flash('partner', 'Berhasil menambahkan Mitra ' . $partner['name']);
    }

    public function handleUpdated($partner){
        // session()->flash('partner', 'Berhasil mengubah Mitra ' . $partner['name']);
    }

    public function getPartner($id){
        
        $this->statusUpdate = true;
        $partner = Partner::find($id);
        $this->emit('getPartner', $partner);
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function destroy($id)
    {
        $partner = Partner::find($id);
        $name = $partner->name;
        Partner::destroy($id);

        session()->flash('partner', 'Berhasil menghapus Mitra ' . $name);
    }

}
