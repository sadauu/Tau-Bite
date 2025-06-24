<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'restaurant_types';

    protected $fillable = ['type'];


	public $timestamps = false;
 
	public function rest_types()
    {
        return $this->hasMany('App\Models\Types', 'id');
    }
	
	public static function getTypeInfo($id) 
    { 
		return Types::find($id);
	}
}
