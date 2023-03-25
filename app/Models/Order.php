<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'order_id', 'expiry_date','subscription_date','plan_name','amount'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
