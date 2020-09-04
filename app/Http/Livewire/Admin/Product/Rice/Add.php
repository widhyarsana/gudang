<?php

namespace App\Http\Livewire\Admin\Product\Rice;

use App\Models\Product;
use Livewire\Component;

class Add extends Component
{
    public $name;
    public $price;
    public $riceId;
    public $statusUpdate;

    protected $listeners = [
        'getRice' => 'showRice'
    ];

    
    public function render()
    {
        return view('livewire.admin.product.rice.add');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'max:15', 'unique:products,name'],
            'price' => 'required'
        ]);

        $data = [
            'name' => $this->name,
            'price' => $this->price,
            'type' => 2,
            'stock' => 0,
        ];

        $rice = Product::create($data);

        $this->resetInput();

        $this->emit('riceStored', $rice);
        $this->emit('alert', ['message' => 'Berhasil mengubah jenis beras ' . $rice->name]);
    }

    public function update()
    {

        $this->validate([
            'name' => ['required', 'max:15'],
            'price' => 'required'
        ]);

        $rice = Product::find($this->riceId);

        $data = [
            'name' => $this->name,
            'price' => $this->price,
            'type' => 2,
            'stock' => $rice->stock,
        ];

        $rice->update($data);

        foreach ($rice->variants as $varian) {
            $varian->price = ($varian->type * $rice->price);
            $varian->save();
        }

        $this->resetInput();

        $this->emit('riceUpdated', $rice);
        $this->emit('riceStock', $rice);
        $this->emit('alert', ['message' => 'Berhasil menambah jenis beras ' . $rice->name]);
    }

    public function showRice($rice)
    {

        $this->name = $rice['name'];
        $this->price = $rice['price'];
        $this->riceId = $rice['id'];

        $this->statusUpdate = true;
    }

    public function resetInput()
    {
        $this->name = '';
        $this->price = '';
    }
}
