<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contract_types extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_type_id', 'user_id', 'address','contract_person'
    ];
}
