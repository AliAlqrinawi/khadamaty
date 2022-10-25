<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['title_en' , 'title_ar' ,  'image' , 'status'];

    public static $rules = [
        'title_ar' => 'required|min:3',
        'title_en' => 'required|min:3',
        'image' => 'required',
    ];

    public function users()
    {
        return $this->hasMany(User::class , 'cat_id' , 'id');
    }
}
