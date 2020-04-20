<?php

namespace App\Http\Middleware;

use App\Utilities\Helper;
use Auth;
use Closure;

class CheckOrderStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = null;
        if ($request->user()->isAdmin != 1) {

            $helper = new Helper();
            $detail = $helper->orderDetails($request->user()->order->receipt_number); //ORder Detail From Click Bank
            if ($detail) {
                $data = json_decode($detail);
                if (!is_null($data) && $data->orderData->lineItemData->status == "ACTIVE") {
                    return $next($request);
                }
                Auth::logout();
                return redirect()->route('login');
            } else {
                Auth::logout();

                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
