<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'Product_Name', 'Product_Price', 'Product_Sale', 'Product_Image_1', 'Product_Image_2',
        'Product_Image_3', 'Product_Desc', 'Product_Unit', 'Product_Quantity', 'Product_Rating',
        'Product_Status', 'Category_Id',
    ];
    protected $primaryKey = 'Product_Id';
    protected $table = 'products';
}