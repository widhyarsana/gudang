<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasRoles;
    protected $guard_name = 'web';

    protected $fillable = [
        'name', 'email', 'phone', 'email', 'address', 'gender'
    ];
    
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%')
                ->orWhere('address', 'like', '%'.$query.'%');
    }
}
