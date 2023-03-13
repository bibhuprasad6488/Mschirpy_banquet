<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    protected $table = 'cuisines';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','cuisine_name','slug', 'status'];

    

    /*public function category() 
     {
        return $this->hasMany(\App\Models\Category::class, 'cuisines_id', 'id');
     }*/
}
