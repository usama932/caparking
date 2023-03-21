<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pay_Plan;
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
use PayPal\Api\AgreementStateDescriptor;
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
         
            $this->client_id = "AQDo_4Msx6bwCWesP5Pb2bgb7LIaeFnprdpowlFt7gvfdoFP3ILaKLYJb5Ssq7xKxopoIf2eEWA7iOw-";
            $this->secret = "EJrvtcJ5Zd5EfVno5A7i2rkAcAQld9ALwXAKeOzvMrb0BK5AimVK0WjOkV-ITk7Nt6Xs7675hyNuMxS6";
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
        
    
        $todayDate = Carbon::now();
        $startDate = Carbon::now()->addMonth();
       
        $planId =  $request->plan_id;
        $plan = Plan::get($planId, $this->apiContext);
        $plan->setId($planId);
       

     
        $agreement = new Agreement();
        $agreement->setName('Monthly Subscription')
                  ->setDescription('Monthly subscription for my service')
                  ->setStartDate($startDate->toIso8601String())
                  ->setPlan($plan->plan_id);
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);
        
        // Create the agreement on PayPal
        try {
            
            $createdAgreement = $agreement->create($this->apiContext);
         
            $approvalUrl = $createdAgreement->getApprovalLink();
        } catch (Exception $e) {
            dd($e);
        }
        
        // Redirect the user to PayPal to approve the agreement
        return redirect()->away($approvalUrl);
        
        // After the user approves the agreement, execute the agreement
        $agreementId = $_GET['token']; // The token returned by PayPal after approval
        $agreement = new Agreement();
        $agreement->execute($agreementId, $this->apiContext);
        dd('sad');
        // Update the user's subscription details in your database
        
    }
}
