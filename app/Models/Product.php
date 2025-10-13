<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'quantity',
        'price',
        'cost'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}