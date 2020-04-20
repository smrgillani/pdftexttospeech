<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacakgeRequest;
use App\Membership;
use App\Package;
use App\Utilities\Helper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackagesController extends Controller
{
    private $helper;
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
        $this->middleware('auth')->except('ListPackages');
    }

    public function ListPackages()
    {
        // display the list of packages for client

        if (auth()->user() && auth()->user()->isAdmin == 1) {
            $data = Package::where('id', '!=', 1)->get();
            return view('packages.index', ["data" => $data]);

        } else {
            $data = Membership::
                where('id', '!=', 1)
                ->orWhere('package_id', '!=', 1)
                ->whereStatus(1)
                ->get();
            return view('packages.packages', ['data' => $data]);
            return view('packages.packagesList', ['data' => $data]);
        }

    }

    public function PackagesAdminPage()
    {
        $data = DB::table('packages')
            ->select('*')
            ->where('Deleted', 0)
            ->get();

        // we will redirect the user to admin page if he is admin
        return view('packages.PackagesAdminPage', ["data" => $data]);
    }
    public function SubscribePackage($id)
    {
        //display the login page
        //Need to have Id of the package
        //check if the package is already subscribed, display message package already subscribed
        //redirect to the payment method when clicked subscribed
        request()->user()->fill(["membership_id" => $id])->save();
        return redirect()->route('home');

    }

    public function RemovePackage()
    {
        //Remove Package from the list

        return view('packages.RemovePackage');

    }
    public function AddPackage()
    {
        //Add new package to the current packages list

        $data = Membership::all();

        return view('packages.AddPackage', ['data' => $data]);
    }
    public function ViewSubscription()
    {
        //view subscribers details
        //select users details
        //select package details

        $data = DB::table('subscribe_package')
            ->join('users', 'subscribe_package.user_id', '=', 'users.id')
            ->join('packages', 'subscribe_package.package_id', '=', 'packages.Id')
            ->select('users.status', 'users.email', 'packages.title', 'users.name', 'users.id as user_id', 'packages.Id as package_id', 'subscribe_package.id', 'subscribe_package.subscribe_time')
            ->where('packages.deleted_at', null)
            ->get();

        return view('packages.ViewSubscribers', ['data' => $data]);

    }
    public function UpdatePackage($id)
    {
        //update package

        $data = DB::table('packages')->select('*')->where('Id', $id)->get();

        return view('packages.UpdatePackage', ['data' => $data]);

    }

    public function AddPackageToDb(PacakgeRequest $request)
    {
        $data = [
            "title"             => $request->title,
            "description"       => $request->description,
            "price"             => $request->price,
            "rebill_commission" => $request->rebillCommission,
            "rebill_price"      => $request->rebillPrice,
            "sku"               => $request->sku,
        ];

        try {
            $sku = $this->helper->addProduct($request->except('_token')); //Add To Click Bank

        } catch (Exception $e) {
            return response()->json([
                'message' => "Package Not Created !",
                'data'    => null,
                'error'   => true,
            ]);
        }

        $package = Package::create($data);
        return view('ajax.package', ["package" => $package, "sku" => $sku]); //Return Single Package To Be Displayed Via Ajax

    }
    public function UpdatePackageToDb()
    {
        //update the package in the db

        $response = 0;

        $id                            = $_REQUEST['id'];
        $dataArray['Name']             = $_REQUEST['packageName'];
        $dataArray['Description']      = $_REQUEST['packageDescription'];
        $dataArray['Price_month']      = $_REQUEST['packagePrice'];
        $dataArray['Updated_datetime'] = date('Y-m-d H:i:s');
        $dataArray['Deleted']          = 0;

        if (DB::table('packages')->where('Id', $id)->where('Deleted', 0)->update($dataArray)) {
            $response = 1;
        }

        echo $response;
    }
    public function DeletePackage(Package $id)
    {

        return $id->forceDelete()
        ? response()->json(["data" => "null", "message" => "Package Deleted", "error" => false])
        : response()->json(["data" => "null", "message" => "Cannot Deleted", "error" => true]);
    }
    public function ChangeUserStatus($id, $status)
    {
        $dataArray['status']     = ($status == 1) ? 0 : 1;
        $dataArray['updated_at'] = date('Y-m-d H:i:s');

        $response = 0;

        if (DB::table('users')->where('id', $id)->update($dataArray)) {
            $response = 1;
        }

        return $response;
    }

    public function ListPackagesForClient()
    {
        //display the packages on the login page

        $data = Package::all();
        dd($data);

        return view('packages.packagesListOnLoginPage', ['data' => $data]);

    }

    public function signupUser($id)
    {
        return view('packages.signup', ['id' => $id]);
    }

    public function createUserInDb()
    {
        //need to return user id
        //we need to get user id from db  after user creation

        $response = 2;

        return $response;
    }

    public function paymentForm($userid, $packageid)
    {
        //need to have userid and package id before returning the form

        echo $userid . $packageid;

    }

    public function SubscribedPackages()
    {
        $data = DB::table('subscribe_package')
            ->join('users', 'subscribe_package.user_id', '=', 'users.id')
            ->join('packages', 'subscribe_package.package_id', '=', 'packages.Id')
            ->select('subscribe_package.package_status', 'users.status', 'users.email', 'packages.Name', 'users.name', 'users.id as user_id', 'packages.Id as package_id', 'subscribe_package.id as subscribe_package_id', 'subscribe_package.subscribe_time')
            ->where('packages.Deleted', 0)
            ->where('users.id', auth()->user()->id)
            ->get();

        return view('packages.subscribedpackagesList', ['data' => $data]);
    }
    public function ChangeSubscriptionStatus($subscription_id, $status)
    {
        $dataArray['package_status'] = ($status == 1) ? 0 : 1;
        $dataArray['updated_at']     = date('Y-m-d H:i:s');

        $response = 0;

        if (DB::table('subscribe_package')->where('id', $subscription_id)->update($dataArray)) {
            $response = 1;
        }

        return $response;

    }

    public function update(Package $package, Request $request)
    {
        $data = [
            "title"             => $request->editTitle,
            "description"       => $request->editDescription,
            "price"             => $request->editPrice,
            "rebill_commission" => $request->editRebillCommission,
            "rebill_price"      => $request->editRebillPrice,
        ];
        if ($package->update($data)) {
            return view('ajax.updatePackage', ["package" => $package]); //Return Updated Package Via Ajax View

        }
    }
    public function packagesearch(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query  = $request->packagesearch;

            if ($query != '') {
                $data = Package::

                    where('id', '<>', 1)
                    ->where('title', 'like', '%' . $query . '%')
                    ->orWhere('sku', 'like', '%' . $query . '%')
                    ->orWhere('price', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();

            } else {
                $data = Package::where('id', '<>', 1)->
                    orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            return response([
                'total_data' => $total_row,
                'table_data' => $data,
            ]);

        }
    }
}
