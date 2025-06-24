<?php

namespace App\Models;

use App\Models\Categories;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    protected $table = 'restaurants';

    protected $fillable = ['type', 'restaurant_name','restaurant_slug','restaurant_description','restaurant_address','delivery_charge','restaurant_logo'];


	public $timestamps = false;
 
	public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurants', 'id');
    }
	
	public static function getRestaurantsInfo($id) 
    { 
		return Restaurants::find($id);
	}

	public static function getUserRestaurant($id) 
    { 
		return Restaurants::where('user_id',$id)->count(); 
	}


	public static function getMenuCategories($id) 
    { 
		return Categories::where('restaurant_id',$id)->count(); 
	}

	public static function getMenuItems($id) 
    { 
		return Menu::where('restaurant_id',$id)->count(); 
	}

	public static function getOrders($id) 
    { 
		return Order::where('restaurant_id',$id)->count(); 
	}

	public static function getTotalRestaurants() 
    { 
		return Restaurants::count(); 
	} 


	public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("restaurant_address", "LIKE","%$keyword%")
                    ->orWhere("restaurant_name", "LIKE", "%$keyword%");                     
            });
        }
        return $query;
    }

    public static function getRestaurantOwnerInfo($id) 
    { 
		$rest=Restaurants::find($id);

		return User::find($rest->user_id);
	}

	public static function getTotalPeopleServed(){
		$orders=Order::where('status','Completed')->count();
		
		return $orders;
	}

}
