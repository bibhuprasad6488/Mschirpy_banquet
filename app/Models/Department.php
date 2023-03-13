<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','department_name','status'];

    public function brand()
    {
    	return $this->hasMany(App\Models\Brand::class,'department_id','id');
    }

    
}
