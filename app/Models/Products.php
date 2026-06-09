<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'image_path',
    ];
}
