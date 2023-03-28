<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'web';
    protected $fillable = [
        'name', 'email', 'password', 'is_admin','assign_role','user_type','added_by','profile_pic'
    ];

  
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function plan()
    {
        return $this->hasOne('App\Models\Pay_PLan','user_id','id');
    }
    public function order()
    {
        return $this->hasOne('App\Models\Order','user_id','id');
    }
    public function contract()
    {
        return $this->hasOne('App\Models\ContractType','user_id','id');
    }
    
}
