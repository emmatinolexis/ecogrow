<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'description',
        'discount_percent',
        'valid_from',
        'valid_to',
        'status'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_discounts');
    }
}
