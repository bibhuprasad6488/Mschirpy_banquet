<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'business_id', 'cuisines_id', 'category_name', 'type', 'tax_type', 'tax_percent', 'price', 'slug', 'status'];
    protected $casts = ['cuisines_id' => 'array'];

    public function menu()
    {
        return $this->hasMany(\App\Models\Menu::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->hasMany(\App\Models\Subcategory::class, 'category_id', 'id');
    }

    public function package()
    {
        return $this->hasMany(\App\Models\Package::class, 'package_id', 'id');
    }
}
