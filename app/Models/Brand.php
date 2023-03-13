<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','department_id','brand_name','status','is_default'];

    public function department()
    {
    	return $this->belongsTo(Department::class,'department_id','id');
    }
    
}
