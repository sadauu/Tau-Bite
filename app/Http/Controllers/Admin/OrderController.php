<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Restaurants;
use App\Models\User;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 
use Session;


class OrderController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function orderlist($id)    { 
        
              
        $order_list = Order::where("restaurant_id", $id)->orderBy('id','desc')->orderBy('created_date','desc')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        
        $restaurant_id=$id; 
        // Group orders by address (from users table)
        $ordersByAddress = DB::table('restaurant_order')
        ->join('users', 'restaurant_order.user_id', '=', 'users.id')
        ->select('users.address', DB::raw('COUNT(*) as total_orders'))
        ->whereIn('restaurant_order.status', ['processing', 'pending']) // ✅ Only include processing or pending
        ->groupBy('users.address')
        ->orderByDesc('total_orders')
        ->get();

// Group orders by campus (from users table)
        $ordersByCampus = DB::table('restaurant_order')
            ->join('users', 'restaurant_order.user_id', '=', 'users.id')
            ->select('users.campus', DB::raw('COUNT(*) as total_orders'))
        ->whereIn('restaurant_order.status', ['processing', 'pending']) // ✅ Only include processing or pending
            ->groupBy('users.campus')
            ->orderByDesc('total_orders')
            ->get();

        return view('admin.pages.order_list',compact('order_list','restaurant_id', 'ordersByAddress', 'ordersByCampus'));
    }
    
    public function alluser_order()    { 
        
              
        $order_list = Order::orderBy('id','desc')->orderBy('created_date','desc')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }

// Group orders by address (from users table)
$ordersByAddress = DB::table('restaurant_order')
    ->join('users', 'restaurant_order.user_id', '=', 'users.id')
    ->select('users.address', DB::raw('COUNT(*) as total_orders'))
    ->groupBy('users.address')
    ->orderByDesc('total_orders')
    ->get();

// Group orders by campus (from users table)
$ordersByCampus = DB::table('restaurant_order')
    ->join('users', 'restaurant_order.user_id', '=', 'users.id')
    ->select('users.campus', DB::raw('COUNT(*) as total_orders'))
    ->groupBy('users.campus')
    ->orderByDesc('total_orders')
    ->get();
        return view('admin.pages.order_list_for_all',compact('order_list', 'ordersByAddress', 'ordersByCampus'));
    }

    public function order_status($id,$order_id,$status)   
    { 
         
        $order = Order::findOrFail($order_id);

        

        $order->status = $status; 
         
        
         
        $order->save();
        
        
            \Session::flash('flash_message', 'Status change');

            return \Redirect::back();
        
    } 
     
    public function delete($id,$order_id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
            
        $order = Order::findOrFail($order_id);
        $order->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    } 
    

    public function owner_orderlist()    { 
        
         $user_id=Auth::User()->id;

         $restaurant= Restaurants::where('user_id',$user_id)->first();

         $restaurant_id=$restaurant['id'];
 

        $order_list = Order::where("restaurant_id", $restaurant_id)->orderBy('created_date')->get();
        
        if(Auth::User()->usertype!="Owner"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        
         // Group orders by address (from users table)
         $ordersByAddress = DB::table('restaurant_order')
         ->join('users', 'restaurant_order.user_id', '=', 'users.id')
         ->select('users.address', DB::raw('COUNT(*) as total_orders'))
         ->where('restaurant_order.status', 'Pending')
         ->where('restaurant_order.restaurant_id', $restaurant_id)
         ->groupBy('users.address')
         ->orderByDesc('total_orders')
         ->get();
     
     $ordersByCampus = DB::table('restaurant_order')
         ->join('users', 'restaurant_order.user_id', '=', 'users.id')
         ->select('users.campus', DB::raw('COUNT(*) as total_orders'))
         ->where('restaurant_order.status', 'Pending')
         ->where('restaurant_order.restaurant_id', $restaurant_id)
         ->groupBy('users.campus')
         ->orderByDesc('total_orders')
         ->get();

        return view('admin.pages.owner.order_list',compact('order_list','restaurant_id', 'ordersByAddress', 'ordersByCampus'));
    }

    public function owner_order_status($order_id,$status)   
    { 
         
        $order = Order::findOrFail($order_id);

        

        $order->status = $status; 
         
        
         
        $order->save();
        
        
            \Session::flash('flash_message', 'Status change');

            return \Redirect::back();
        
    } 

    public function owner_delete($order_id)
    {
        if(Auth::User()->usertype!="Owner"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
            
        $order = Order::findOrFail($order_id);
        $order->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    } 

}
