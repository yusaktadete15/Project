<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['code','name', 'stock', 'price', 'image'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function orderItem()
    {
    	return $this->hasMany(OrderItem::class);
    }
}
