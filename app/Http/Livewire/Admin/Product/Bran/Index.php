<?php

namespace App\Http\Livewire\Admin\Product\Bran;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $added = 'nothing';
    public $qty;
    public $price;

    public function render()
    {
        return view('livewire.admin.product.bran.index', ['bran' => Product::find(3)]);
    }

    public function updateQty(){
        $this->validate([
            'qty' => 'required'
        ]);

        $bran = Product::find(3);

        $bran->stock += $this->qty;
        $bran->save();
        
        $this->qty = '';

        $this->emit('alert', ['message' => 'Berhasil menambah stok dedak ' . $bran->name]);
    }

    public function updatePrice(){
        $this->validate([
            'price' => 'required'
        ]);

        $bran = Product::find(3);

        $bran->price = $this->price;
        $bran->save();
        
        $this->price = '';

        $this->emit('alert', ['message' => 'Berhasil mengubah harga dedak ' . $bran->name]);
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
