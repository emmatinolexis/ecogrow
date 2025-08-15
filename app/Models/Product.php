<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductOption;

class Product extends Model
{
    use HasFactory;

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'brand_id',
        'status',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'product_discounts');
    }

    public function getActiveDiscountAttribute()
    {
        $now = now()->toDateString();
        return $this->discounts
            ->where('status', 'active')
            ->where('valid_from', '<=', $now)->where('valid_to', '>=', $now)
            ->first();
    }

    public function getDiscountedPriceAttribute()
    {
        $discount = $this->active_discount;
        if ($discount) {
            return round($this->price * (1 - $discount->discount_percent / 100), 2);
        }
        return $this->price;
    }
}