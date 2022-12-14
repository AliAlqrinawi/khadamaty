<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $fillable = ['title_en' , 'title_ar' , 'duration' , 'price'];

    public function WorkersPackages()
    {
        return $this->hasMany(PackageOrder::class , 'package_id' , 'id');
    }
}
