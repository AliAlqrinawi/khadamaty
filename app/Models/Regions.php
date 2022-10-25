<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;

    protected $fillable = ['province_id' , 'title_en' , 'title_ar' , 'status'];

    public function users()
    {
        return $this->hasMany(User::class , 'regino_id' , 'id');
    }

    public function provinces()
    {
        return $this->belongsTo(Provinces::class , 'province_id' , 'id');
    }
}
