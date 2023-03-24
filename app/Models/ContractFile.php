<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_id', 'file'
 
     ];
     public function contract()
     {
         return $this->belongsTo('App\Models\Contract','contract_id','id');
     }
}
