<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Response;
class SolarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	 
	 
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 public function index(Request $request)
    {
		return Response::json(array(
            'error' 	=> false,
            'status_code' => 200
        ));
	
    }
    public function show(Request $request)
    {
		
	
    }
	public function create()
    {
		  echo "ggg";
       //return view('ProductCRUD.create');
    }
	public function store()
    {
    return Response::json(array(
            'error' 	=> false,
            'status_code' => 200
        ));
    }
	
	public function edit($id)
    {
        echo "fff";
    }
	
	   public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required',
        ]);
        Product::find($id)->update($request->all());
        return redirect()->route('productCRUD.index')
                        ->with('success','Product updated successfully');
    }
 public function test(Request $request)
 {
	 echo "ffff";
 }

	
}
