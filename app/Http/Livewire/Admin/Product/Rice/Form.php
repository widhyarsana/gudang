<?php

namespace App\Http\Livewire\Admin\Product\Rice;

use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;

class Form extends Component
{
    public $riceId;
    public $kindRice;
    public $type;
    public $stock;
    public $variantId;

    public $statusVariantUpdate;

    protected $listeners = [
        'getVariant' => 'showVariant'
      ];

      public function mount($kindRice){
        $this->kindRice = $kindRice;
      }

    public function render()
    {
        return view('livewire.admin.product.rice.form');
    }

    public function storeVariant(){
        $this->riceId = '';
        $this->type = '';
        $this->stock = '';
        $this->total_stock = '';
        $this->price = '';
        $this->statusVariantUpdate = false;
    }

    public function showVariant($variant){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->riceId = $variant['product_id'];
        $this->variantId = $variant['id'];
        $this->type = $variant['type'];
        $this->stock = $variant['stock'];

        $this->statusVariantUpdate = true;
    }

    public function store(){
        $this->validate([
            'riceId' => ['required'],
            'type' => ['required'],
            'stock' => ['required'],
        ], $this->messagesValidate(), $this->customAttributes());
        
        $errors = $this->getErrorBag();
        
        $rice = Product::find($this->riceId);
        $exist = false;

        foreach($rice->variants as $variant){
            if($this->type == $variant->type){
                $exist = true;
            }
        }

        if($exist){
            $errors->add('type', 'Tipe beras sudah ada');
        }else{
            $data = [
                'product_id' => $this->riceId,
                'type' => $this->type,
                'stock' => $this->stock,
                'total_stock' => ($this->stock * $this->type),
                'price' => ($this->type * $rice->price),
            ];
    
            $variant = ProductVariant::create($data);
    
            $this->resetInput();
    
            $this->emit('variantStored', $variant);
            $this->emit('riceStock', $rice);
            $this->emit('alert', ['message' => 'Berhasil menambah varian beras ' . $variant->type . ' Kg']);
            $exist = false;
        }

    }

    public function update(){
        $this->validate([
            'riceId' => ['required'],
            'type' => ['required'],
            'stock' => ['required'],
        ], $this->messagesValidate(), $this->customAttributes());

        $variant = ProductVariant::find($this->variantId);

        $data = [
            'product_id' => $this->riceId,
            'type' => $this->type,
            'stock' => $this->stock,
            'total_stock' => ($this->stock * $this->type),
            'price' => ($this->type * $variant->product->price),
        ];

        $variant->update($data);

        $this->resetInput();
        $this->emit('variantUpdated', $variant);
        $this->emit('riceStock', $variant->product);
        $this->emit('alert', ['message' => 'Berhasil menambah varian beras ' . $variant->type . ' Kg']);
    }

    public function resetInput(){
        $this->riceId = '';
        $this->type = '';
        $this->stock = '';
    }

    // Atribut Kustom untuk message
    public function customAttributes(){
        return [
            'type' => 'Tipe',
            'stock' => 'Jumlah',
        ];
    }

    public function messagesValidate(){
        return  [
            'required' => ' :attribute tidak boleh kosong.'
        ];
    }
}
