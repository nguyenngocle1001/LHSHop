<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'Name', 'Favicon', 'Logo', 'Address', 'el', 'Email'
    ];
    protected $primaryKey = 'Id';
    protected $table = 'Systems';
}