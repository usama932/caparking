<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    
    use HasFactory;
    protected $fillable = [
       'contract_type_id','users', 'user_id', 'address','contract_person','subject','name_contracting_party','contract_start_date','contract_end_date',
        'notify_by_email',''

    ];
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
    public function setUsersAttribute($value)
    {
        $this->attributes['users'] = json_encode($value);
    }
  
   
}
