<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractType;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use DB;

class ContactTypeController extends Controller
{
	
	function __construct()
    {
            $this->middleware('permission:contract-list|get-contract|get-contracts|contract-create|contract-edit|contract-delete', ['only' => ['index','store']]);
            $this->middleware('permission:contract-create', ['only' => ['create','store']]);
            $this->middleware('permission:contract-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:contract-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $title = "Contract Types";
        return view('admin.contract_type.index',compact('title'));
    }
    public function getContacttype(Request $request){
		$columns = array(
			0 => 'id',
			1 => 'title',
			3 => 'created_at',
			4 => 'action'
		);
		
		$totalData = ContractType::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$contracts = ContractType::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = ContractType::count();
		}else{
			$search = $request->input('search.value');
			$contracts = ContractType::where([
				['title', 'like', "%{$search}%"],
			])   
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = ContractType::where([
				
				['title', 'like', "%{$search}%"],
			])
				->orWhere('title', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}
		
		
		$data = array();
		
		if($contracts){
			foreach($contracts as $r){
				$edit_url = route('contact_types.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="contracts[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['title'] = $r->title;
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
	public function contacttypeDetail(Request $request)
	{
		$title = "Contracts Type Details";
        $contract = ContractType::find($request->id);
        
		return view('admin.contract_type.detail', compact('contract','title'));
	}
    public function create()
    {
        $title = "Contract Types";
		return view('admin.contract_type.create',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
           
        ]);
        $contracttype = new ContractType;
        $contracttype->title = $request->input('title');
		
        $contracttype->save();
        Session::flash('success_message', 'Contract Type successfully update!');
        return  redirect()->route('contact_types.index')
                          ->with('success','Contact Types created successfully');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $title = "Contracts Type Edit";
        $contract = ContractType::find($id);    
		return view('admin.contract_type.edit', compact('contract','title'));

    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'title' => 'required',
           
        ]);
        $contracttype = ContractType::find($id);
        $contracttype->title = $request->input('title');
        $contracttype->save();
        Session::flash('success_message', 'Contract Type successfully update!');
        return  redirect()->route('contact_types.index')
                          ->with('success','Contact Types created successfully');
    }

    public function destroy($id)
    {
	    $contracttypes = ContractType::find($id);
	    if(!empty($contracttypes)){
		    $contracttypes->delete();
		    Session::flash('success_message', 'Contract types successfully deleted!');
	    }
	    return redirect()->route('contact_types.index');
	   
    }
	public function deleteSelectedcontacttype(Request $request)
	{
		$input = $request->all();
		$this->validate($request, [
			'contracts' => 'required',
		
		]);
		foreach ($input['contracts'] as $index => $id) {
			
			$contracts = ContractType::find($id);
			if(!empty($contracts)){
				$contracts->delete();
			}
			
		}
		Session::flash('success_message', 'Contracts successfully deleted!');
		return redirect()->back();
		
	}
}
