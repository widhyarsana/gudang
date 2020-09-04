<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name', 'stock', 'price', 'type'];

    public function variants(){
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
