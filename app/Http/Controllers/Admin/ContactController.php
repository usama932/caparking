<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Contract_types;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Models\User;
use DB;

class ContactController extends Controller
{
   
    public function index()
    {
        $title = "Contract";
        return view('admin.contracts.index',compact('title'));
    }
    public function getContacts(Request $request){
		$columns = array(
			0 => 'id',
			1 => 'contract_type_id',
            2 => 'user_id',
            3 => 'contract_person',
			4 => 'created_at',
			5 => 'action'
		);
		
		$totalData = Contracts::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$contracts = Contracts::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Contracts::count();
		}else{
			$search = $request->input('search.value');
			$contracts = Contracts::where([
				['contract_person', 'like', "%{$search}%"],
			])   
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Contracts::where([
				
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
				$nestedData['contract_type_id'] = $r->contract_type_id;
                $nestedData['user_id'] = $r->user_id;
                $nestedData['contract_person'] = $r->contract_person;
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
	public function contactDetail(Request $request)
	{
		$title = "Contracts Details";
        $contract = Contracts::find($request->id);
        
		return view('admin.contracts.detail', compact('contract','title'));
	}
    public function create()
    {
        $title = "Contract Types";
        $contract_types = Contract_types::latest()->get();
        $users = User::where('is_admin', '0')->get();
		return view('admin.contracts.create',compact('title','contract_types','users'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'contract_type_id' => 'required',
            'user_id' => 'required',
            'contract_person' => 'required',
           
        ]);
        $contract        = new Contracts;
        $contract->contract_type_id = $request->input('contract_type_id');
        $contract->user_id = $request->input('user_id');
        $contract->contract_person = $request->input('contract_person');
        $contract->address = $request->input('address');
        $contract->save();
        Session::flash('success_message', 'Contract successfully update!');
        return  redirect()->route('contacts.index')
                          ->with('success','Contact  created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = "Contracts Edit";
        $contract = Contracts::find($id);
        $contract_types = Contract_types::latest()->get();
        $users = User::where('is_admin', '0')->get();
        
		return view('admin.contracts.edit', compact('contract','title','contract_types','users'));
    }

  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'contract_type_id' => 'required',
            'user_id' => 'required',
            'contract_person' => 'required',
           
        ]);
        $contract        = Contracts::find($id);
        $contract->contract_type_id = $request->input('contract_type_id');
        $contract->user_id = $request->input('user_id');
        $contract->contract_person = $request->input('contract_person');
        $contract->address = $request->input('address');
        $contract->save();
        Session::flash('success_message', 'Contract successfully update!');
        return  redirect()->route('contacts.index')
                          ->with('success','Contact  created successfully');
    }

    public function destroy($id)
    {
	    $contract = Contracts::find($id);
	    if(!empty($contract)){
		    $contract->delete();
		    Session::flash('success_message', 'Contract  successfully deleted!');
	    }
	    return redirect()->route('contacts.index');
	   
    }
	public function deleteSelectedcontract(Request $request)
	{
		$input = $request->all();
		$this->validate($request, [
			'contracts' => 'required',
		
		]);
		foreach ($input['contracts'] as $index => $id) {
			
			$contracts = Contracts::find($id);
			if(!empty($contracts)){
				$contracts->delete();
			}
			
		}
		Session::flash('success_message', 'Contracts successfully deleted!');
		return redirect()->back();
		
	}
}
