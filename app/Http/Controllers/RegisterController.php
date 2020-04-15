<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\User;
use Validator;
class RegisterController extends Controller
{
	

  	public function register()
    {
      
    	$link=request()->fullUrl();

        return view('auth.register',compact('link'));
    }

   	public function process(Request $request)
    {

    	$rules = [
            'name' =>'required' ,
            'email' =>'required',
            'password' =>'required|confirmed',
            'password_confirmation' =>'required',
        ];
         $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
    
          return redirect()->back()->withErrors($validator);
        }
        else{
              $user=User::where('email',$request->email)->first();
              if(!empty($user)){
              	$user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'updated_at' => date('Y-m-d H:i:s'),
            	]);
            	return !empty($user) ? redirect('home')->with([
                'message' => "User created Successfully",
                'data' => $user,
            ], 201):
      			redirect()->back()->withErrors([
                'message' => $user,
                'data' => null,
            ]);
            }else{
              	return redirect()->back()->withErrors([
                'message' => 'Email Not Exists',
                'data' => null,
            	]);
            }
                
      
             

                

            
            
        }
    }
}
