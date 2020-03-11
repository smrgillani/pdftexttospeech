<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\User;
use App\Membership;
use Validator;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::Where('isAdmin' ,null)->orderBy('id', 'desc')
         ->get();
          $memberships=$this->membership();
        return view('user.index',compact('users','memberships'));
    }

        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $rules = [
            'email' =>'required' ,
   
        ];
         $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
            return response()->json(['error' => $validator], 200);

        }else{
                $user=User::where('email',$request->email)->first();

                $link= URL::temporarySignedRoute('register', now()->addDay(), ['email' => $request->email ]);
                
                if(!empty($user)){

                    Mail::to($request->email)->send(new SendEmail($link));

                    return response()->json([
                'message' => "New Invitation link is forward to ". $request->email,
                ], 200);
              
                }
                else{

                    $newuser=User::create([
                    'email' => $request->email,
                    ]);
                    Mail::to($request->email)->send(new SendEmail($link));
                   return !empty($newuser) ? response()->json([
                    'message' => "Invitation link is forward to ". $request->email,
                    'data' => User::Where('id' ,$newuser->id)->first(),
                    'error' => false
                    ], 201):
                        response()->json([
                        'message' => 'User can not be created',
                        'data' => null,
                        'error' => true,
                    ]); 
                }
             
                        
            }
                
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $memberships=$this->membership();

        $user=User::whereId($id)->first();
        return view('user.edit',['user'=>$user,'memberships'=>$memberships]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
             $rules = [
            'name' =>'required' ,
            'status' =>'required',
        
        ];
         $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
          return response()->json(['error' => $validator], 200);
        }else{
        $usr=$user->update([
            'name' => $request->name,
            'status' => $request->status,
            'membership_id' => $request->membership_id ? $request->membership_id : null,
        ]);
   
        return $usr == true ? response()->json([
                'message' => "User updated Successfully",
                'data' => User::Where('isAdmin' ,null)->orderBy('id', 'desc')->get(),
                'error' => false,
            ], 201):
                response()->json([
                'message' => 'User not updated',
                'data' => null,
                'error' => true,
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $message=$user->delete();
        return $message==true ? response()->json([
                'message' => "User deleted successfully",
                'data' => User::Where('isAdmin' ,null)->orderBy('id', 'desc')
         ->get(),
                'error' => false,
            ], 200):
                response()->json([
                'message' => "User can not be deleted",
                'data' => null,
                'error' => true,
            ],200);
    }

    public function profile(){
       $memberships=$this->membership();  
        $user=User::whereId(auth()->user()->id)->first();              
        return view('user.profile',['user'=>$user,'memberships'=>$memberships]);
    }

    public function membership(){
         $memberships=Membership::where('id','<>',1)->get();
        
            if(count($memberships) >= 1){
            $memberships=$memberships;
            } 
          else{
            $memberships=[];
         }
         return $memberships;
    }

    public function usersearch(Request $request)
    {
             if($request->ajax())
     {
      $output = '';
      $query = $request->user;
      
      if($query != '')
      {
       $data = User::Where('id','!=',auth()->user()->id)
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('email', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
       
      }
      else
      {
       $data = User::Where('id','!=',auth()->user()->id)
         ->orderBy('id', 'desc')
         ->get();
      }
        $total_row = $data->count();
        return response([
            'total_data'  => $total_row,
            'table_data'  => $data,
        ]);
           
       

     }
    }


}
