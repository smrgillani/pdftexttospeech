<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Package;
use App\Membership;
use Validator;
use Mail;

class RegisterController extends Controller
{
	

  	public function register()
    {
      
    	$link=request()->fullUrl();

      return view('auth.register',compact('link'));
    }

    public function useraccountManagement(Request $request){
      
      $secretKey = "THISISMYSECRECTK";

      $bodyContent = $request->getContent();
      $bodyContent = json_decode(trim($bodyContent));

      $encrypted = $bodyContent->{'notification'};
      $iv = $bodyContent->{'iv'};

      $decrypted = trim(openssl_decrypt(base64_decode($encrypted), 'AES-256-CBC', substr(sha1($secretKey), 0, 32), OPENSSL_RAW_DATA, base64_decode($iv)), "\0..\32");

      $decrypted = json_decode(trim($decrypted));

      $customerShipping = "";
      $customerBilling = "";

      $userEmail = "";


      if($decrypted->{'transactionType'} == "TEST_SALE"){
      
        $_decrypted = $decrypted;
        $decrypted = $decrypted->{'customer'};
        $customerShipping = $decrypted->{'shipping'};
        $customerBilling = $decrypted->{'billing'};
        $receiptNo = $_decrypted->{'receipt'};

        $productSKU = $_decrypted->lineItems;
        $productSKU = $productSKU[0]->itemNo;

        $package=Package::whereSku($productSKU)->first();
        $membership=Membership::wherePackageId($package->id)->first();


        if($customerShipping->{'email'} != ''){
          $userEmail = $customerShipping->{'email'};
        }else if($customerBilling->{'email'} != ''){
          $userEmail = $customerBilling->{'email'};
        }


        if(!empty($userEmail)){

          $user=User::where('email',$userEmail)->first();

          if(!empty($user)){
              
          }else{

            $newuser=User::create(['email' => $userEmail,'membership_id' => $membership->id, 'status' => '1']);
            
            $newuser->order()->create(["receipt_number" => $receiptNo, "membership_id" => $membership->id]);
            
            $this->html_email($userEmail);

          }

        }


      }else if(strpos($decrypted->{'transactionType'}, 'SUBSCRIPTION-CHG') !== false){
        
        $productSKU = explode('>', $decrypted->{'transactionType'});

        $productSKU = isset($productSKU[1]) ? $productSKU[1] : '0';

        $_decrypted = $decrypted;
        $decrypted = $decrypted->{'customer'};
        $customerShipping = $decrypted->{'shipping'};
        $customerBilling = $decrypted->{'billing'};
        $receiptNo = $_decrypted->{'receipt'};

        $package=Package::whereSku($productSKU)->first();
        $membership=Membership::wherePackageId($package->id)->first();

        if(!empty($package)){

          if($customerShipping->{'email'} != ''){
            $userEmail = $customerShipping->{'email'};
          }else if($customerBilling->{'email'} != ''){
            $userEmail = $customerBilling->{'email'};
          }


          if(!empty($userEmail)){

            $user=User::where('email',$userEmail)->first();

            if(!empty($user)){

              $user->fill(['membership_id' => $membership->id, 'status' => '1'])->save();
              $user->order()->update(["membership_id" => $membership->id]);
                
            }else{

            }

          }

        }


      }

      return response()->json($decrypted);

    }

    public function html_email($toEmailAddr) {
      
      $link= URL::temporarySignedRoute('user.register', now()->addDay(), ['email' => $toEmailAddr ]);

      $data = array('link'=>$link);
      
      Mail::send('email', $data, function($message) use ($toEmailAddr) {
         $message->to($toEmailAddr, '')->subject('Audio Robot Sign-Up Invitation');
         $message->from('no-reply@audiorobot.net','Audio Robot');
      });
      
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
