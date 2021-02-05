<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'Product_Id', 'Size_Id'
    ];
    protected $primaryKey = 'PS_Id';
    protected $table = 'product_size';
}