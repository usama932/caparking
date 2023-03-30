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
use App\Models\User;
use App\Models\ContractFile;
use DB;

class ContactController extends Controller
{
	function __construct()
    {
            $this->middleware('permission:contract-list|get-contract|get-contracts|contract-create|contract-edit|contract-delete', ['only' => ['index','store','getContacts','contactDetail']]);
            $this->middleware('permission:contract-create', ['only' => ['create','store','getContacts','contactDetail']]);
            $this->middleware('permission:contract-edit', ['only' => ['edit','update','getContacts','contactDetail']]);
            $this->middleware('permission:contract-delete', ['only' => ['destroy','getContacts','contactDetail']]);
    }
    public function index()
    {
        $title = "Contract";
        return view('admin.contracts.index',compact('title'));
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
         
			$contracts = Contract::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Contract::count();
		}else{
           
			$search = $request->input('search.value');
			$contracts = Contract::where([
				['contract_person', 'like', "%{$search}%"],
			])   
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Contract::where([
				
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
                                    <a title="Edit Contract" class="btn btn-sm btn-clean btn-icon"
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
	public function contactDetail(Request $request)
	{
		$title = "Contracts Details";
        $contract = Contract::with('file','contract')->find($request->id);
        $users = json_decode($contract->users);
		return view('admin.contracts.detail', compact('contract','title','users'));
	}
    public function create()
    {
        
        $title = "Contract Types";
        $contract_types = ContractType::latest()->get();
        $users = User::where('is_admin', '0')->get();
		return view('admin.contracts.create',compact('title','contract_types','users'));
    }

    
    public function store(Request $request)
    {  

        dd($request->all());
        $this->validate($request, [
            'contract_type_id' => 'required',
            /*'name_contracting_party' => 'required',*/
            'contract_person' => 'required',
            'contract_start_date' => 'required',
            'contract_end_date' => 'required',
           
        ]);
      
        $contract        = new Contract;
        $contract->contract_type_id = $request->input('contract_type_id');
        $contract->contract_person = $request->input('contract_person');
        $contract->name_contracting_party = $request->input('name_contracting_party');
        $contract->contract_start_date = $request->input('contract_start_date');
        $contract->contract_end_date = $request->input('contract_end_date');
        $contract->subject = $request->input('subject');
        $contract->address = $request->input('address');
        $contract->notify_by_email = $request->input('notify_by_email');
        $contract->users = $request->input('users');
        $contract->added_by = auth()->user()->id;

        $contract->save();
 
        if ($request->hasFile('file')) {
			if ($request->file('file')->isValid()) {
				$this->validate($request, [
					'file' => 'required|mimes:jpeg,png,jpg'
				]);
				$file = $request->file('file');
				$destinationPath = public_path('/contractfile');
				$filename = $file->getClientOriginalName('file');
				$filename = rand() . $filename;
				$request->file('file')->move($destinationPath, $filename);
				
                $contractfile       = new ContractFile;
                $contractfile->contract_id = $contract->id;
                $contractfile->file = $filename;
                $contractfile->save();
			}
            
		}

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
        $title = "Contract Edit";
        $contract = Contract::with('user')->find($id);
        $contract_types = ContractType::latest()->get();
        $users = User::where('is_admin', '0')->get();
      
		return view('admin.contracts.edit', compact('contract','title','contract_types','users'));
    }

  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'contract_type_id' => 'required',
            'name_contracting_party' => 'required',
            'contract_person' => 'required',
            'contract_start_date' => 'required',
            'contract_end_date' => 'required',
           
        ]);
      
        $contract        = Contract::find($id);
        $contract->contract_type_id = $request->input('contract_type_id');
        $contract->contract_person = $request->input('contract_person');
        $contract->name_contracting_party = $request->input('name_contracting_party');
        $contract->contract_start_date = $request->input('contract_start_date');
        $contract->contract_end_date = $request->input('contract_end_date');
        $contract->subject = $request->input('subject');
        $contract->address = $request->input('address');
        $contract->notify_by_email = $request->input('notify_by_email');
        $contract->users = $request->input('users');
        $contract->save();
        if (!empty($request->file)) {
        
			if ($request->file('file')->isValid()) {
				$this->validate($request, [
					'file' => 'required|mimes:jpeg,png,jpg'
				]);
				$file = $request->file('file');
				$destinationPath = public_path('/contractfile');
				$filename = $file->getClientOriginalName('file');
				$filename = rand() . $filename;
				$request->file('file')->move($destinationPath, $filename);
				
                $contractfiled        = ContractFile::where('contract_id',$contract->id)->first();
                $contractfiled->delete();

                $contractfile       = new ContractFile;
                $contractfile->contract_id = $contract->id;
                $contractfile->file = $filename;
                $contractfile->save();
			}
            
		}
        Session::flash('success_message', 'Contract successfully update!');
        return  redirect()->route('contacts.index')
                          ->with('success','Contact  created successfully');
    }

    public function destroy($id)
    {
	    $contract = Contract::find($id);
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
			
			$contracts = Contract::find($id);
			if(!empty($contracts)){
				$contracts->delete();
			}
			
		}
		Session::flash('success_message', 'Contracts successfully deleted!');
		return redirect()->back();
		
	}
}
