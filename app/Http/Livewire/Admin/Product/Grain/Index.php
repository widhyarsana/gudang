<?php

namespace App\Http\Livewire\Admin\Product\Grain;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $added = false;
    public $qty;

    public function render()
    {
        return view('livewire.admin.product.grain.index', ['grain' => Product::find(1)]);
    }

    public function update(){
        $this->validate([
            'qty' => 'required'
        ]);

        $grain = Product::find(1);

        $grain->stock += $this->qty;
        $grain->save();
        
        $this->qty = '';

        $this->emit('alert', ['message' => 'Berhasil menmabah stok gabah ' . $grain->name]);


    }

    public function add(){
        $this->added = true;
    }

    public function cancel(){
        $this->added = false;
    }

}
