<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'Size_Name', 'Size_Desc', 'Size_Status'
    ];
    protected $primaryKey = 'Size_Id';
    protected $table = 'Sizes';
}