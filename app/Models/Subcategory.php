<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','category_id','subcategory_name','slug','status'];

    public function category() {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }

    public function menu()
    {
        return $this->hasMany(\App\Models\Menu::class,'subcategory_id','id');
    }
}
