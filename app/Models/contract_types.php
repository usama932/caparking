<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract_types extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];
}
