<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Validator;
use Request;
use Response;
use Auth;

class ImageController extends Controller
{
    public function imageupload()
    {	
    	 $input = Input::all();
        
        // VALIDATION RULES
        $rules = array(
            'file' => 'image',
        );
    
       
        $validation = Validator::make($input, $rules);
 
        
        
        
        
           $file = array_get($input,'file');
           
            $destinationPath = 'uploads';
            $id = Auth::user()->id;
            $extension = $file->getClientOriginalExtension();
                       $fileName =  $id. '.' . $extension;
            
            $upload_success = $file->move($destinationPath, $fileName);
            if($upload_success)
            {
            	return back();
            }

    	
    }
}
