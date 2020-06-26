<?php

namespace App\Http\Controllers;

use App\Order;
use App\Package;
use App\Utilities\Helper;
use Illuminate\Http\Request;
use App\Membership;

class OrderController extends Controller
{
    private $helper;
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index',["orders"=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = request()->user();

        if ($user->can('create-order')) {
            $package = Package::whereSku(request()->item)->first();
            $user->order()->create(["receipt_number" => request()->cbreceipt, "membership_id" => $package->membership->id]);
            $user->fill(["membership_id" => $package->membership->id])->save();
        }
        return redirect()->route('home');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $memberships=$this->membership();
        return view('orders.show',["order"=>$order,'memberships'=>$memberships]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    public function switchPackage(Request $request){
         $this->helper->changeProduct($request->receipt,$request->oldSku,$request->membership_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
