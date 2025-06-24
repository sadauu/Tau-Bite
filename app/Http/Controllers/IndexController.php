<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Categories;
use App\Models\Menu;
use App\Models\Restaurants;
use App\Models\Review;
use App\Models\Types;
use App\Models\User;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	 

    public function index()
    { 
    	// if($this->alreadyInstalled()) {
        //     return redirect('install');
        // }
    	 
         $types=Types::orderBy('type')->get();  

         $restaurants = DB::table('restaurants')
                           ->leftJoin('restaurant_types', 'restaurants.restaurant_type', '=', 'restaurant_types.id')                           
                           ->select('restaurants.*','restaurant_types.type')
                           ->where('restaurants.review_avg', '>=', '4')
                           ->orderBy('restaurants.review_avg', 'desc')
                           ->take(6)
                           ->get();

                           $popularItems = DB::table('restaurant_order')
        ->join('restaurants', 'restaurant_order.restaurant_id', '=', 'restaurants.id')
        ->join('restaurant_types', 'restaurants.restaurant_type', '=', 'restaurant_types.id')
        ->select(
            'restaurant_order.item_name',
            'restaurants.restaurant_name',
            'restaurants.restaurant_slug',
            'restaurants.restaurant_logo',
            'restaurants.restaurant_address',
            'restaurant_types.type',
            'restaurants.review_avg',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(
            'restaurant_order.item_name',
            'restaurants.restaurant_name',
            'restaurants.restaurant_slug',
            'restaurants.restaurant_logo',
            'restaurants.restaurant_address',
            'restaurant_types.type',
            'restaurants.review_avg'

        )
        ->orderByDesc('total')
        ->take(5)
        ->get();

        
          

        return view('pages.index',compact('restaurants','types', 'popularItems'));
    }
    
    public function about_us()
    { 
                  
        return view('pages.about');
    }

    public function contact_us()
    {        
        return view('pages.contact');
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }

    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
     
     public function login()
    { 
                   
        return view('pages.login');
    }

    public function postLogin(Request $request)
    {
        
    //echo bcrypt('123456');
    //exit; 
        
      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');

         
        
         if (Auth::attempt($credentials, $request->has('remember'))) {

            if(Auth::user()->usertype=='banned'){
                \Auth::logout();
                return array("errors" => 'You account has been banned!');
            }

            return $this->handleUserWasAuthenticated($request);
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/login')->withErrors('The email or the password is invalid. Please try again.');
        
    }
    
     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/'); 
    }
    
    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        \Session::flash('flash_message', 'Logout successfully...');

        return redirect('/login');
    }


    public function register()
    { 
                   
        return view('pages.register');
    }

    public function register_user(Request $request)
    { 
        
        $data =  $request->except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|max:75|unique:users',
                'password' => 'required|min:3|confirmed'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
       
        $user = new User;

        
        $user->usertype = $inputs['usertype'];
        $user->first_name = $inputs['first_name']; 
        $user->last_name = $inputs['last_name'];       
        $user->email = $inputs['email'];         
        $user->password= bcrypt($inputs['password']); 
       
         
        $user->save();
        
       

            \Session::flash('flash_message', 'Register successfully...');

            return redirect()->route('login')->with('flash_message', 'Register succcessfully... Kindly Login');

         
    }    

    public function profile()
    { 
        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);

        return view('pages.profile',compact('user'));
    } 
    

    public function editprofile(Request $request)
    { 
        
        $data =  $request->except(array('_token')) ;
        
        $inputs = $request->all();
        
        
            $rule=array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|max:75',
                'mobile' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'address' => 'required'
                 );
       
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
        $user_id=Auth::user()->id;
           
        $user = User::findOrFail($user_id);
 
         
        
        $user->first_name = $inputs['first_name']; 
        $user->last_name = $inputs['last_name'];       
        $user->email = $inputs['email'];
        $user->mobile = $inputs['mobile'];
        $user->city = $inputs['city'];
        $user->postal_code = $inputs['postal_code'];
        $user->address = $inputs['address'];         
         
         
        $user->save();
        
         
            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
         
         
    }        

    public function change_password()
    { 
        
        return view('pages.change_password');
    }

        
     public function edit_password(Request $request)
    { 
        
        $data =  $request->except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(                
                'password' => 'required|min:3|confirmed'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
       
        $user_id=Auth::user()->id;
           
        $user = User::findOrFail($user_id);
       
        $user->password= bcrypt($inputs['password']);  
        
         
        $user->save(); 

            \Session::flash('flash_message', 'Password has been changed...');

            return \Redirect::back();

         
    } 


    public function contact_send(Request $request)
    { 
        
        $data =  $request->except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(                
                'name' => 'required',
                'email' => 'required|email|max:75'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
            $data = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'subject' => $inputs['subject'],
            'user_message' => $inputs['message'],
             );

            $subject=$inputs['subject'];

            \Mail::send('emails.contact', $data, function ($message) use ($subject){

                $message->from(getcong('site_email'), getcong('site_name'));

                $message->to(getcong('site_email'))->subject($subject);

            });
        

            \Session::flash('flash_message', 'Thank You. Your Message has been Submitted.');

            return \Redirect::back();

         
    }    
}
