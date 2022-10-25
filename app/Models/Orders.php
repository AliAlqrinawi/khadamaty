<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public function Custmers()
    {
        return $this->belongsTo(User::class , 'custmer_id' , 'id');
    }
    
    public function Workers()
    {
        return $this->belongsTo(User::class , 'worker_id' , 'id');
    }
}
