<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    const LIMIT = 20;

    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'image'
    ];

    public function limit()
    {
        return Str::limit($this->description, Product::LIMIT);
    }
    /**
     * Get all of the bill for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bill_details()
    {
        return $this->hasMany(BillDetail::class);
    }
}
