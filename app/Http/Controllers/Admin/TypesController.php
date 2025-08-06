<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\Types;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Intervention\Image\Facades\Image; 


class TypesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function types()    { 
        
              
        $types = Types::orderBy('type')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
         
        return view('admin.pages.types',compact('types'));
    }
    
    public function addeditType()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        
        return view('admin.pages.addedittype');
    }
    
    public function addnew(Request $request)
    { 
    	
    	$data =  $request->except(array('_token')) ;
	    
	    $rule=array(
		        'type' => 'required'		         
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	    $inputs = $request->all();
		
		if(!empty($inputs['id'])){
           
            $type_obj = Types::findOrFail($inputs['id']);

        }else{

            $type_obj = new Types;

        }

        $destination_path = public_path('upload/type');

        if(!file_exists($destination_path)){
            mkdir($destination_path, 0755, true);
        }

        //News image
        $type_image = $request->file('type_image');
         
        if($type_image){
            
             \File::delete(public_path() .'/upload/type/'.$type_obj->type_image);
             
            
            $tmpFilePath = 'upload/type/';          
             
            $hardPath = substr($inputs['type'],0,100).'_'.time();
            $fileName = $hardPath .'.'. $type_image->getClientOriginalExtension();
            
            $img = Storage::url($type_image);

            $type_image->move($tmpFilePath, $fileName);
            asset($tmpFilePath . $fileName);
            //$img->fit(98, 98)->save($tmpFilePath.$hardPath. '-s.jpg');

            $type_obj->type_image = $fileName;
             
        }
		 
		
		$type_obj->type = $inputs['type']; 
		 
		
		 
	    $type_obj->save();
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function editType($id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	     
          $type = Types::findOrFail($id);
          
          return view('admin.pages.addedittype',compact('type'));
        
    }	 
    
    public function delete($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	
        $type = Types::findOrFail($id);
        $type->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
     
    	
}
