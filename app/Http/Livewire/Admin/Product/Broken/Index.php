<?php

namespace App\Http\Livewire\Admin\Product\Broken;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $added = 'nothing';
    public $qty;
    public $price;

    public function render()
    {
        return view('livewire.admin.product.broken.index', ['broken' => Product::find(5)]);
    }

    public function updateQty(){
        $this->validate([
            'qty' => 'required'
        ]);

        $broken = Product::find(5);

        $broken->stock += $this->qty;
        $broken->save();
        
        $this->qty = '';

        $this->emit('alert', ['message' => 'Berhasil menambah stok broken ' . $broken->name]);
    }

    public function updatePrice(){
        $this->validate([
            'price' => 'required'
        ]);

        $broken = Product::find(5);

        $broken->price = $this->price;
        $broken->save();
        
        $this->price = '';

        $this->emit('alert', ['message' => 'Berhasil mengubah harga broken ' . $broken->name]);
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
