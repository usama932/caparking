<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;

class RateController extends Controller
{
    function __construct()
    {
            $this->middleware('permission:rate-list|get-rate|get-rates|rate-create|rate-edit|rate-delete', ['only' => ['index','store']]);
            $this->middleware('permission:rate-create', ['only' => ['create','store']]);
            $this->middleware('permission:rate-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:rate-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $title = 'Rates';
	    return view('admin.rates.index',compact('title'));
    }

    public function getrates(Reques $request){
        $columns = array(
			0 => 'id',
			1 => 'name',
			2 => 'email',
			3 => 'active',
			4 => 'created_at',
			5 => 'action'
		);

		$totalData = User::where('user_type', 'company')->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if(empty($request->input('search.value'))){
			$users = User::where('user_type', 'company')->offset($start)
				->limit($limit)
				->orderBy($order,$dir)
                ->with('order')
				->get();
			$totalFiltered = User::where('is_admin', 1)->count();
		}else{
			$search = $request->input('search.value');
			$users = User::where([
				['title', 'like', "%{$search}%"],
			])
				->orWhere('price','like',"%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
                ->with('order')
				->get();
			$totalFiltered = Rate::where([

				['title', 'like', "%{$search}%"],
			])
				->orWhere('price', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}


		$data = array();

		if($rates){
			foreach($rates as $r){
				$edit_url = route('clients.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="rates[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['title'] = $r->title;
				$nestedData['price'] = $r->price;

				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Rate" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>

                                    <a title="Edit Rate" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Rate" href="javascript:void(0)">
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

    public function rateDetail(Reques $request){

    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
