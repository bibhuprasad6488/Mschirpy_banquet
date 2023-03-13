<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSubCategory extends Model
{
    use HasFactory;
    protected $table = 'tax_sub_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','category','subcat','status'];

    public function taxcat()
    {
    	return $this->belongsTo(\App\Models\TaxCategory::class, 'category', 'id');
    }
}
