<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category_name', 'category_slug'];


	public $timestamps = false;
 
	public function news()
    {
        return $this->hasMany('App\Models\News', 'cat_id');
    }
	
	public static function getCategoryInfo($id) 
    { 
		return Categories::find($id);
	}
}
