<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Categories;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Restaurants;
use App\Models\Review;
use App\Models\Types;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;


class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
         
    }
    public function index()
    { 
    	 if(Auth::user()->usertype=='Admin')	
          {  
        		$types = Types::count(); 
        		$restaurants_count = Restaurants::count(); 
        	 	$order = Order::count(); 
        	 	$users = User::where('usertype', 'User')->count(); 

            return view('admin.pages.dashboard',compact('types','restaurants_count','order','users'));

	      }

          if(Auth::user()->usertype=='Owner')
          {
            
            $user_id=Auth::User()->id;

            $restaurant= Restaurants::where('user_id',$user_id)->first();

            

            // if(!$restaurant){
              // return redirect()->back()->with('error','User hasn\'t register for an account.');
            // }
            $restaurant_id=$restaurant['id'];


             

            $categories_count = Categories::where(['restaurant_id' => $restaurant_id])->count();

            $menu_count = Menu::where(['restaurant_id' => $restaurant_id])->count();

            $order_count = Order::where(['restaurant_id' => $restaurant_id])->count();

            $review_count = Review::where(['restaurant_id' => $restaurant_id])->count();

             

           
             
               return view('admin.pages.owner_dashboard',compact('categories_count','menu_count','order_count','review_count')); 
          }
	    	  
    	
        
    }
	
	 
    	
}
