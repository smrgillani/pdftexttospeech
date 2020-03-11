<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Package;
class PackagesLoginPageController extends Controller
{

    Public function ListPackages()
    {
        // display the list of packages for client

    
        $data = DB::table('packages')
        ->select('*')
        ->where('Deleted', 0)
        ->get();

        if(auth()->user()->isAdmin== 1)
        {
            return view('packages.PackagesAdminPage', [ "data" =>$data ]);
        }
        else
        {
            return view('packages.packagesList',['data' => $data]);
        }
        
    }

    public function PackagesAdminPage()
    {
        $data = DB::table('packages')
        ->select('*')
        ->where('Deleted', 0)
        ->get();

    
        // we will redirect the user to admin page if he is admin
        return view('packages.PackagesAdminPage', [ "data" =>$data ]);
    }
    public function SubscribePackage($id)
    {
        //display the login page
        //Need to have Id of the package
        //check if the package is already subscribed, display message package already subscribed
        //redirect to the payment method when clicked subscribed

        $packages = DB::table('packages')
        ->select('*')
        ->where('id',$id)
        ->get();

        if(isset(auth()->user()->id))
        {
        $response = 0;

        $dataArray['package_id'] = $id;
        $dataArray['user_id'] = auth()->user()->id;
        $dataArray['subscribe_time'] = date('Y-m-d H:i:s');
        $dataArray['created_at'] = date('Y-m-d H:i:s');
        $dataArray['membership_id'] = $packages[0]->membership_id;

        $ifAlreadSubscribed = 0;

       $data =  DB::table('subscribe_package')
       ->select('*')
       ->where('user_id',auth()->user()->id)
       ->where('package_id',$id)
       ->get();


       if(count($data) != 0)
       {
           $ifAlreadSubscribed = 1;
           $response = 2;
       }

       if($ifAlreadSubscribed == 0)
       {
        if(DB::table('subscribe_package')->insert($dataArray))
        {
            $response = 1;
        }
       }

       return $response;
    }
    else{

        $response = $id;
        return $response;
    }
        
    }

    public function RemovePackage()
    {
        //Remove Package from the list

        return view('packages.RemovePackage');

    }
    public function AddPackage()
    {
        //Add new package to the current packages list

        $data = DB::table('memberships')
        ->select('*')
        ->where('status',1)
        ->get();

        return view('packages.AddPackage',['data'=>$data]);
    }
    public function ViewSubscription()
    {
        //view subscribers details
        //select users details
        //select package details

        $data = DB::table('subscribe_package')
        ->join('users','subscribe_package.user_id','=','users.id')
        ->join('packages','subscribe_package.package_id','=','packages.Id')
        ->select('users.status','users.email','packages.Name','users.name','users.id as user_id','packages.Id as package_id','subscribe_package.id','subscribe_package.subscribe_time')
        ->where('packages.Deleted', 0)
        ->get();


        return view('packages.ViewSubscribers',['data' => $data]);
        
    }
    public function UpdatePackage($id)
    {
        //update package

        $data = DB::table('packages')->select('*')->where('Id', $id)->get();

        return view('packages.UpdatePackage',['data' => $data]);
        
    }

    public function AddPackageToDb()
    {
        $response = 0;
        // get the data from the form and update it in db

        $packageName = $_REQUEST['PackageName'];
        $packageDescription = $_REQUEST['PackageDescription'];
        $packagePrice = $_REQUEST['PackagePrice'];
        $createdDateTime = date('Y-m-d H:i:s');

        $dataArray['Name'] = $packageName;
        $dataArray['Description'] = $packageDescription;
        $dataArray['Price_month'] = $packagePrice;
        $dataArray['Created_datetime'] = $createdDateTime;
        $dataArray['membership_id'] = $_REQUEST['membership_id'];
        $dataToAdd[] = json_encode($dataArray);



        //update the data in db
        //update response to 1

        if(DB::table('packages')->insert($dataArray))
        {
            $response = 1;
        }

        echo $response;
    }
    public function UpdatePackageToDb()
    {
        //update the package in the db

        $response = 0;

        $id = $_REQUEST['id'];
        $dataArray['Name'] = $_REQUEST['packageName'];
        $dataArray['Description'] =$_REQUEST['packageDescription'];
        $dataArray['Price_month'] = $_REQUEST['packagePrice'];
        $dataArray['Updated_datetime'] = date('Y-m-d H:i:s');
        $dataArray['Deleted'] = 0;

        if(DB::table('packages')->where('Id', $id)->where('Deleted', 0)->update($dataArray))
        {
            $response = 1;
        }

        echo $response;
    }
    public function DeletePackage($id)
    {
        $response = 0;

        $dataArray['Updated_datetime'] = date('Y-m-d H:i:s');
        $dataArray['Deleted'] = 1;

        if(DB::table('packages')->where('Id', $id)->update($dataArray))
        {
            $response = 1;
        }

        echo $response;
    }
    public function ChangeUserStatus($id,$status)
    {
        $dataArray['status'] = ($status == 1)? 0:1;
        $dataArray['updated_at'] = date('Y-m-d H:i:s');

        $response = 0;

        if(DB::table('users')->where('id',$id)->update($dataArray))
        {
            $response = 1;
        }

        return $response;
    }

    public function ListPackagesForClient()
    {
        //display the packages on the login page

        $data = Package::all();

            return view('packages.packagesListOnLoginPage',['data' => $data]);
        

    }

    public function signupUser($id)
    {
        return view('packages.signup',['id' => $id]);
    }

    public function createUserInDb()
    {
        //need to return user id 
        //we need to get user id from db  after user creation

        $response = 2;

        return $response;
    }

    public function paymentForm($userid,$packageid)
    {
        //need to have userid and package id before returning the form

        echo $userid.$packageid;

    }

    public function SubscribedPackages()
    {
        $data = DB::table('subscribe_package')
        ->join('users','subscribe_package.user_id','=','users.id')
        ->join('packages','subscribe_package.package_id','=','packages.Id')
        ->select('subscribe_package.package_status','users.status','users.email','packages.Name','users.name','users.id as user_id','packages.Id as package_id','subscribe_package.id as subscribe_package_id','subscribe_package.subscribe_time')
        ->where('packages.Deleted', 0)
        ->where('users.id',auth()->user()->id)
        ->get();

        return view('packages.subscribedpackagesList',['data' => $data]);
    }
    public function ChangeSubscriptionStatus($subscription_id,$status)
    {
        $dataArray['package_status'] = ($status == 1)? 0:1;
        $dataArray['updated_at'] = date('Y-m-d H:i:s');

        $response = 0;

        if(DB::table('subscribe_package')->where('id',$subscription_id)->update($dataArray))
        {
            $response = 1;
        }

        return $response;
    }
    public function curl_request()
    {
        $postData['currency'] = 'HKD';
        $postData['language'] = 'EN';
        $postData['price'] = 123;
        $postData['site'] = 'audiogen';
        $postData['title'] = 'audiogen';
        $postData['categories'] = 'EBOOK';
        $postData['description'] = 'some sample description';
        $postData['digitalRecurring'] = 1;
        $postData['duration'] ='MONTHLY';
        $postData['frequency'] ='MONTHLY';
        $postData['rebillCommission'] =25;
        $postData['rebillPrice'] =123;
        $postData['thankYouPage'] ='http://audiorobot.net/';
        $postData['trialPeriod'] =1;
        $postData['pitchPage'] = 'http://audiorobot.net/';
        $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.clickbank.com/rest/1.3/1");
    curl_setopt($ch, CURLOPT_HEADER, true); 
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Authorization: DEV-6JV3FQGROH27F223599A0D37BHEJJ829"));
    $result = curl_exec($ch);
    curl_close($ch);
    // echo $result;exit;
        
       
         $ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
        
        //$url = "https://api.clickbank.com/rest/1.3/products?currency=HKD&language=EN&price=123&site=audiogen&title=audiogen&categories=EBOOK&description=somedescription&digitalRecurring=1&duration=MONTHLY&frequency=MONTHLY&rebillCommission=5&rebillPrice=123&thankYouPage=1&trialPeriod=0";

        $url = "https://api.clickbank.com/rest/1.3/products/abc";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_HEADER, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
         curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300000);
         curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Authorization:  DEV-6JV3FQGROH27F223599A0D37BHEJJ829 "));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/xml", "Authorization: << DEVELOPER KEY >:<< API KEY >>"));
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($httpCode == 504) {
    /* Handle 504 here. */
    $result = curl_exec($ch);
    } else {
    /* Process data */
    }
        curl_close($ch);

        echo "<pre>";print_r($result);
    }


}