<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay_Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price', 'plan_id', 'is_admin'
    ];
}
