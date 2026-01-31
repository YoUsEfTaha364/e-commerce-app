<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'price',
        'sale_price',
        'quantity',
        'status',
        'category_id'

    ];

    public function getDiscountAttribute()
    {

        $discount = round(100 - ($this->sale_price / $this->price) * 100);


        return $discount;
    }



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }
}
