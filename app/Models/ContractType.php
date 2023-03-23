<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];
    public function contracts()
    {
        return $this->hasMany('App\Models\Contracts','contract_type_id','id');
    }
}
