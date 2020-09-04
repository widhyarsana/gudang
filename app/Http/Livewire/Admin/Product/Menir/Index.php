<?php

namespace App\Http\Livewire\Admin\Product\Menir;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $added = 'nothing';
    public $qty;
    public $price;

    public function render()
    {
        return view('livewire.admin.product.menir.index', ['menir' => Product::find(4)]);
    }

    public function updateQty(){
        $this->validate([
            'qty' => 'required'
        ]);

        $menir = Product::find(4);

        $menir->stock += $this->qty;
        $menir->save();
        
        $this->qty = '';

        $this->emit('alert', ['message' => 'Berhasil menambah stok ' . $menir->name]);
    }

    public function updatePrice(){
        $this->validate([
            'price' => 'required'
        ]);

        $menir = Product::find(4);

        $menir->price = $this->price;
        $menir->save();
        
        $this->price = '';

        $this->emit('alert', ['message' => 'Berhasil mengubah harga menir ' . $menir->name]);
    }

    public function add(){
        $this->added = 'add';
    }
    public function price(){
        $this->added = 'price';
    }

    public function cancel(){
        $this->added = 'nothing';
    }
}
