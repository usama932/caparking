<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractType;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\ContractFile;
use DB;

class ContactController extends Controller
{
  
    public function index()
    {
        $title = "Contract";
        return view('admin.contracts.staff_contracts',compact('title'));
    }
    public function getContacts(Request $request){
    
		$columns = array(
			0 => 'id',
            1 => 'user_id',
            2 => 'contract_person',  
			3 => 'created_at',
			4 => 'action'
		);
		
		$totalData = Contract::count();
    
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
         
			$contracts = Contract::where('added_by',auth()->user()->added_by)->offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Contract::where('added_by',auth()->user()->added_by)->count();
		}else{
           
			$search = $request->input('search.value');
			$contracts = Contract::where('added_by',auth()->user()->added_by)->where([
				['contract_person', 'like', "%{$search}%"],
			])   
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Contract::where('added_by',auth()->user()->added_by)->where([
				
				['contract_person', 'like', "%{$search}%"],
			])
				->orWhere('contract_person', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}
		
        
		$data = array();
		
		if($contracts){
			foreach($contracts as $r){
				$edit_url = route('contacts.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="contracts[]" value="'.$r->id.'"><span></span></label></td>';
                $nestedData['user_id'] = $r->name_contracting_party;
                $nestedData['start_date'] = $r->contract_start_date;
                $nestedData['end_Date'] = $r->contract_end_date;
                $nestedData['contract_person'] = $r->contract_person;
				
				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Contract" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
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
	public function contactDetail(Request $request)
	{
		$title = "Contracts Details";
        $contract = Contract::with('file','contract')->find($request->id);
        $users = json_decode($contract->users);
		return view('admin.contracts.detail', compact('contract','title','users'));
	}
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    
    public function show($id)
    {
        

    }
    public function edit($id)
    {
        
    }
 
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
    
    }
}
