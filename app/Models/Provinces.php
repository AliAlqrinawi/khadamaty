<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;


    protected $fillable = ['title_en' , 'title_ar' , 'status'];

    public function regions()
    {
        return $this->hasMany(Regions::class , 'province_id' , 'id');
    }
}
