<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pay_Plan;
use App\Models\Order;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use Carbon\Carbon;

class PayPalPaymentController extends Controller
{
    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;
	public function __construct()
    {
        // Detect if we are running in live mode or sandbox
        if(config('paypal.settings.mode') == 'live'){

            $this->client_id = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {

            $this->client_id = "AfmjY4alrGIOZiR9EnwpPmFRdx2SczcVA4CPsrInvOFsutPkIpJye47GStV24MvSrsh_uSIdmfWsSr7m";
            $this->secret = "ELhokVQ2hhzVUWRr4pThD9mCAh6T81vOI4UTL5Ta56P_W43miZokpwsMtC7wARZ5nqjoJlMNNX8wuqbG";
        }

        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));

         $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function handlePayment($id){
        $plan = Pay_Plan::find($id);

        return view('paypal.paywithpaypal',compact('plan'));
    }
    public function paymentSuccess(Request $request){

        $now    = Carbon::now();
        $expiry =  Carbon::now()->addMonth();
        try
        {


            $order = Order::create([
                'user_id' => auth()->user()->id,
                'order_id' => $request->order['id'],
                'plan_name' => $request->plan_name,
                'amount' => $request->amount,
                'expiry_date' => $expiry,
                'subscription_date' => $now,
            ]);

           return $order;

        }
        catch(\PayPal\Exception\PayPalConnectionException $ex)
        {

        }



        return redirect()->route('admin.dashboard');
    }
}
