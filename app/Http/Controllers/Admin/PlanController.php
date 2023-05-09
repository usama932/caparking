<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
use App\Models\Setting;

class PlanController extends Controller
{

	private $apiContext;
    private $mode;
    private $client_id;
    private $secret;
	public function __construct()
    {
        $this->middleware('permission:plan-list|get-plan|get-plans|plan-create|plan-edit|plan-delete', ['only' => ['index','store']]);
        $this->middleware('permission:plan-create', ['only' => ['create','store']]);
        $this->middleware('permission:plan-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:plan-delete', ['only' => ['destroy']]);
        $live = Setting::where('name','live')->first();

        $client_id =  Setting::where('name','client_id')->first();
        $secret =  Setting::where('name','secret_id')->first();
        // Detect if we are running in live mode or sandbox
        if(!empty($live->value) && !empty($secret) && !empty($client_id)){

            $this->client_id = $client_id->value;
            $this->secret =  $secret->value;
        } else {

            $this->client_id = "AQDo_4Msx6bwCWesP5Pb2bgb7LIaeFnprdpowlFt7gvfdoFP3ILaKLYJb5Ssq7xKxopoIf2eEWA7iOw-";
            $this->secret = "EJrvtcJ5Zd5EfVno5A7i2rkAcAQld9ALwXAKeOzvMrb0BK5AimVK0WjOkV-ITk7Nt6Xs7675hyNuMxS6";
        }

        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));

         $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function index()
    {
        $title  = "Plans";
        $plans = Pay_Plan::count();
        return view('admin.plans.index',compact('title','plans'));
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
                                    <a title="Edit Plan" class="btn btn-sm btn-clean btn-icon"
                                    href="'.$edit_url.'">
                                    <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Contract" href="javascript:void(0)">
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
        $plan = Pay_Plan::find($request->id);

		return view('admin.plans.detail', compact('plan','title'));
	}

    public function create()
    {
        $title = "Plan";
		return view('admin.plans.create',compact('title'));
    }


    public function store(Request $request)
    {
       // dd($this->apiContext);
        $this->validate($request, [
		    'name' => 'required|max:255',
		    'sub_name' => 'required',

	    ]);
		$plan = new Plan();
        $plan->setName($request->name)
          ->setDescription($request->sub_name)
          ->setType('fixed');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Subscription')
          ->setType('REGULAR')
          ->setFrequency('Month')
          ->setFrequencyInterval('1')
          ->setCycles('12')
          ->setAmount(new Currency(array('value' => $request->price, 'currency' => 'USD')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl('https://website.dev/subscribe/paypal/return')
          ->setCancelUrl('https://website.dev/subscribe/paypal/return')
          ->setAutoBillAmount('yes')
          ->setInitialFailAmountAction('CONTINUE')
          ->setMaxFailAttempts('3');

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
                'sub_name' =>   $request->sub_name,
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
        $title = "Edit Plan";
        $plan = Pay_Plan::find($id);
		return view('admin.plans.edit',compact('title','plan'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
		    'name' => 'required|max:255',
		    'sub_name' => 'required',
            'price' => 'required',

	    ]);

        $planId = $request->pin;
        $updateplan = Plan::get($planId,$this->apiContext);

        $updateplan->delete($this->apiContext);

        $pay_plan = Pay_Plan::find($id);

        $pay_plan->delete();



		$plan = new Plan();
        $plan->setName($request->name)
          ->setDescription($request->sub_name)
          ->setType('fixed');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Subscription')
          ->setType('REGULAR')
          ->setFrequency('Month')
          ->setFrequencyInterval('1')
          ->setCycles('12')
          ->setAmount(new Currency(array('value' => $request->price, 'currency' => 'USD')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl('https://website.dev/subscribe/paypal/return')
          ->setCancelUrl('https://website.dev/subscribe/paypal/return')
          ->setAutoBillAmount('yes')
          ->setInitialFailAmountAction('CONTINUE')
          ->setMaxFailAttempts('3');

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
                'sub_name' =>   $request->sub_name,
            ]);
        }

        Session::flash('success_message', 'Plan  successfully update!');
        return  redirect()->route('plans.index')
                          ->with('success','Plans  created successfully');
    }

    public function destroy($id)
    {



	    if(!empty($plan)){
		    $plan->delete();
		    Session::flash('success_message', 'plan successfully deleted!');
	    }
	    return redirect()->route('plans.index');

    }
	public function deleteSelectedPlan(Request $request)
	{
		$input = $request->all();
		$this->validate($request, [
			'plans' => 'required',

		]);
		foreach ($input['plans'] as $index => $id) {

			$plan = Pay_Plan::find($id);

            $planId = $plan->plan_id;
            $updateplan = Plan::get($planId,$this->apiContext);
            $updateplan->delete($this->apiContext);

			if(!empty($plan)){
				$plan->delete();
			}

		}
		Session::flash('success_message', 'plans successfully deleted!');
		return redirect()->back();

	}
}

