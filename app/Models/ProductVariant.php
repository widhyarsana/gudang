<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'type', 'price', 'stock', 'total_stock'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('type', 'like', '%'.$query.'%');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
