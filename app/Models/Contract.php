<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function contract()
    {
        return $this->belongsTo('App\Models\ContractType','contract_type_id','id');
    }

    public function file()
    {
        return $this->hasOne('App\Models\ContractFile','contract_id','id');
    }



}
