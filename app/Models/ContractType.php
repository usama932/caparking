<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','added_by'
    ];
    public function contracts()
    {
        return $this->hasMany('App\Models\Contract','contract_type_id','id');
    }
}
