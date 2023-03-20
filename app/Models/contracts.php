<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;
    protected $fillable = [
       'contract_type_id', 'user_id', 'address','contract_person'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function contract()
    {
        return $this->belongsTo('App\Models\Contract_types','contract_type_id','id');
    }

}
