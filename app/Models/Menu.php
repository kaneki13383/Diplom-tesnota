<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function types()
    {
        return $this->belongsTo(Type::class, 'type');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function products_order()
    {
        return $this->belongsTo(ProductsOrder::class, 'id');
    }
}
