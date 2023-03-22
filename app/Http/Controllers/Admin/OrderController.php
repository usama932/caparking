<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use DB;
 

class OrderController extends Controller
{
	
	function __construct()
    {
            $this->middleware('permission:order-list|get-order|get-orders|order-create|order-edit|order-delete', ['only' => ['index','store']]);
            $this->middleware('permission:order-create', ['only' => ['create','store']]);
            $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $title  = "Order";
        return view('admin.order.index',compact('title'));
    }
    public function getOrders(Request $request){
		$columns = array(
			0 => 'id',
			1 => 'user_id',
            2 => 'plan_id',
			3 => 'expiry_date',
			4 => 'subscription_date',
			5 => 'created_at',
			5 => 'action'
		);
		
		$totalData = Order::with('user')->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$orders = Order::with('user')->offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Order::with('user')->count();
		}else{
			$search = $request->input('search.value');
			$orders = Order::with('user')->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Order::with('user')->where('created_at','like',"%{$search}%")
				->count();
		}
		
		
		$data = array();
		
		if($orders){
			foreach($orders as $r){
				$edit_url = route('plans.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="orders[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['user_id'] = $r->user->name;
                $nestedData['plan_id'] = $r->plan_id;
				$nestedData['expiry_date'] = $r->expiry_date;
				$nestedData['subscription_date'] = $r->subscription_date;
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
	public function orderDetail(Request $request)
	{
		$title = "Order Details";
        $order = Order::find($request->id);
        
		return view('admin.order.detail', compact('order','title'));
	}
   

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
		$order = Order::find($id);
	    if(!empty($order)){
		    $order->delete();
		    Session::flash('success_message', 'Order successfully deleted!');
	    }
	    return redirect()->route('orders.index');
    }
	public function deleteSelectedOrders(Request $request){

		$input = $request->all();
		$this->validate($request, [
			'orders' => 'required',
		
		]);
		foreach ($input['orders'] as $index => $id) {
			
			$order = Order::find($id);
			if(!empty($order)){
				$order->delete();
			}
			
		}
		Session::flash('success_message', 'Order successfully deleted!');
		return redirect()->back();
	}
}
