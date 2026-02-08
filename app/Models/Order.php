<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_phone',
        'address',
        'discount',
        'delivery_charge',
        'coupon_discount',
    ];
    protected $casts = [
        'discount' => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
    ];
    public function orders()
    {
        return $this->hasMany(OrderCount::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_counts')
            ->withPivot('quantity')
            ->withTimestamps();
    }
 
    

}
