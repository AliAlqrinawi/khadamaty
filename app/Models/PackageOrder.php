<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageOrder extends Model
{
    use HasFactory;
    protected $table = "package_orders";
    
    public function Workers()
    {
        return $this->belongsTo(User::class , 'worker_id' , 'id');
    }

    public function Packages()
    {
        return $this->belongsTo(Packages::class , 'package_id' , 'id');
    }
}
