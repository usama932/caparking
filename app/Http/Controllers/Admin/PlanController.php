<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use DB;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use App\Models\Pay_Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class PlanController extends Controller
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
         
            $this->client_id = "AafB64h3oMPvW1Gk5p-pJwDFJtGVEYsJ9eL19BfUDFqUugaZFQZQS_MU8BY1bdGq6E3t0LwmZOizbZiV";
            $this->secret = "EF9M9g7BlJwgJzzqBiCXtwqoV-2rEs9Y6MnTVslOiK0fARqdgobftEXj0v5ihZED-MgWecoIORfyHcj5";
        }
      
        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        
         $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function index()
    {
        $title  = "Plans";
        return view('admin.plans.index',compact('title'));
    }
    public function getPlans(Request $request){
		$columns = array(
			0 => 'id',
			1 => 'name',
            3 => 'plan_id',
			4 => 'created_at',
			5 => 'action'
		);
		
		$totalData = Pay_Plan::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$plans = Pay_Plan::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Pay_Plan::count();
		}else{
			$search = $request->input('search.value');
			$plans = Pay_Plan::where('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Pay_Plan::where([
				
				['name', 'like', "%{$search}%"],
			])
                ->orWhere('price','like',"%{$search}%")   
				->orWhere('name', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}
		
		
		$data = array();
		
		if($plans){
			foreach($plans as $r){
				$edit_url = route('plans.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="plans[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['name'] = $r->name;
                $nestedData['price'] = $r->price;
                
				if($r->active){
					$nestedData['active'] = '<span class="label label-success label-inline mr-2">Active</span>';
				}else{
					$nestedData['active'] = '<span class="label label-danger label-inline mr-2">Inactive</span>';
				}
				
				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit Client" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                    </a>
                                </td>
                                </div>
                            ';
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);
		
		echo json_encode($json_data);
		
	}
	public function planDetail(Request $request)
	{
		$title = "Plan Details";
        $plan = Plan::find($request->id);
        
		return view('admin.plans.detail', compact('plan','title'));
	}
   
    public function create()
    {
        $title = "Plan";
		return view('admin.plans.create',compact('title'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
		    'name' => 'required|max:255',
		    'sub_name' => 'required',
		    
	    ]);
		$plan = new Plan();
        $plan->setName($request->name)
          ->setDescription($request->sub_name)
          ->setType('infinite');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
          ->setType('REGULAR')
          ->setFrequency('Month')
          ->setFrequencyInterval('1')
          ->setCycles('0')
          ->setAmount(new Currency(array('value' => $request->price, 'currency' => 'USD')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl('https://website.dev/subscribe/paypal/return')
          ->setCancelUrl('https://website.dev/subscribe/paypal/return')
          ->setAutoBillAmount('yes')
          ->setInitialFailAmountAction('CONTINUE')
          ->setMaxFailAttempts('0');

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        //create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);

            try {
                $patch = new Patch();
                $value = new PayPalModel('{"state":"ACTIVE"}');
                $patch->setOp('replace')
                  ->setPath('/')
                  ->setValue($value);
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);
                $createdPlan->update($patchRequest, $this->apiContext);
                $plan = Plan::get($createdPlan->getId(), $this->apiContext);

                // Output plan id
               
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        } 
        if(!empty($plan->getId())){
            $payplan = Pay_Plan::create([
                'name' =>   $request->name,
                'plan_id' => $plan->getId(),
                'price' =>  $request->price,
            ]);
        }
        Session::flash('success_message', 'Plan  successfully update!');
        return  redirect()->route('plans.index')
                          ->with('success','Plans  created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
