<?php

namespace App\Http\Livewire\Admin\Product\Rice;

use App\User;
use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $confirming;
    public $statusUpdate = false;
    public $statusVariantUpdate = false;
    public $paginate = 5;
    public $search = '';
    public $sortField = 'created_at';
    public $sortAsc = true;

    protected $listeners = [
        'riceStored' => 'handleRiceStored',
        'riceUpdated' => 'handleRiceUpdated',
        'variantStored' => 'handleVariantStored',
        'variantUpdated' => 'handleVariantUpdated',
        'riceStock' => 'handleRiceStock',
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
        return view('livewire.admin.product.rice.index', [
                'variants' => 
                    ProductVariant::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->latest()->paginate($this->paginate),
                    'kindRice' => Product::where('type', 2)->get() 
                ]);
    }



    public function handleRiceStored($rice){
        // session()->flash('rice', 'Berhasil menambahkan jenis beras ' . $rice['name']);
    }
    public function handleRiceUpdated($rice){
        // session()->flash('rice', 'Berhasil memperbarui jenis beras ' . $rice['name']);
    }
    public function handleVariantStored($variant){
        // session()->flash('rice', 'Berhasil menambahkan varian beras ' . $variant['type']. ' Kg');
    }
    public function handleVariantUpdated($variant){
        // session()->flash('rice', 'Berhasil memperbarui varian beras ' . $variant['type'] . ' Kg');
    }
    public function handleRiceStock($rice){
        $stock = 0;
        $product = Product::find($rice['id']);

        foreach($product->variants as $variant){
            $qty = ($variant->type * $variant->stock);
            $stock = $stock + $qty;
        }

        $product->stock = $stock;
        $product->save();
    }




    public function getRice($id){
        $this->statusUpdate = true;
        $rice = Product::find($id);
        $this->emit('getRice', $rice);
    }

    public function getVariant($id){
        $this->statusVariantUpdate = true;
        $variant = ProductVariant::find($id);
        $this->emit('getVariant', $variant);
    }

    public function confirmDelete($id)
    {
        $this->confirmRice = $id;
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        $name = $admin->name;
        User::destroy($id);

        session()->flash('admin', 'Berhasil menghapus Admin ' . $name);
    }
}
