<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCategory extends Model
{
    use HasFactory;
    protected $table = 'tax_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','category_name'];

    public function subcat()
    {
    	return $this->hasMany(\App\Models\TaxSubCategory::class, 'category', 'id');
    }
}
