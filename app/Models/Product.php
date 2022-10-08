<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'tax'];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function getTaxAmountAttribute()
    {
        return round(($this->price * $this->tax) / 100, 2) ;
    }

    public function getPriceWithTaxAttribute()
    {
        return $this->price + $this->tax_amount;
    }
}
