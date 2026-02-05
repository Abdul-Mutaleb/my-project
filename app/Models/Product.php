<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'category_id',
        'product_price',
        'product_number',
        'product_image',
    ];
    protected $casts = [
         'product_price' => 'decimal:2',
        'discount' => 'decimal:2',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
