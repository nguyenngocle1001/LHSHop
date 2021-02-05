<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'Category_Name', 'Category_Desc', 'Category_Status'
    ];
    protected $primaryKey = 'Category_Id';
    protected $table = 'Categorys';
}