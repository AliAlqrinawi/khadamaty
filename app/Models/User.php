<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function OrderCustmers()
    {
        return $this->hasMany(Orders::class , 'custmer_id' , 'id');
    }
    
    public function OrderWorkers()
    {
        return $this->hasMany(Orders::class , 'worker_id' , 'id');
    }

    public function Categories()
    {
        return $this->belongsTo(Categories::class , 'cat_id' , 'id');
    }

    public function Packages()
    {
        return $this->hasMany(PackageOrder::class , 'worker_id' , 'id');
    }

    public function regino()
    {
        return $this->belongsTo(Regions::class , 'regino_id' , 'id');
    }

    public function FavCustmers()
    {
        return $this->hasMany(Fav::class , 'custmer_id ' , 'id');
    }
    
    public function FavWorkers()
    {
        return $this->hasMany(Fav::class , 'worker_id' , 'id');
    }
    
    public function roles(){
        return $this->belongsToMany(Role::class , 'role_user');
    }
    
    public function permissions($permissions)
    {
            foreach($this->roles as $role){
                if(in_array($permissions ,  $role->permissions)){
                    return true;
                }
                else{
                    return false;
                }
            }
    }
}
