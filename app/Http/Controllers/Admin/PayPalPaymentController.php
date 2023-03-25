<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pay_Plan;
use App\Models\Order;
use App\Http\Requests;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Plan;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Agreement;
use PayPal\Api\Subscription;
use PayPal\Api\SubscriptionPlan;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Api\FundingInstrument;
use PayPal\Api\CreditCard;
use PayPal\Api\ShippingAddress;
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
