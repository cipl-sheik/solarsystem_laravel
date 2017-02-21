<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Solar_model;
use Response;

class SolarsystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $response['result']=Solar_model::get();
	if(count($response['result'])==0){
		$message= "No solar list found";
	  }else{
		$message="Solar List Returned"; 
	  }
	  	return Response::json(array(
            'error' 	=> false,
			"message" => $message,
			"response" => $response,
        )); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /* Store the solar system  */
    public function store(Request $request)
    {
       $findDuplicate=Solar_model::where('name',$request->input('name'))->first();
       if(count($findDuplicate)>0){
        return Response::json(array(
            'error'     => false,
            "message" => "Solar allready exist",
        )); 
       }else{
       $addSolar=Solar_model::create(array(
                            'name'    => $request->input('name'),
                            'size'    => $request->input('size'),
                            'coordinate_x'    => $request->input('coordinate_x'),
                            'coordinate_y'    => $request->input('coordinate_y'),
                            'coordinate_z'    => $request->input('coordinate_z'),
       ));
     
       if($addSolar){
           return Response::json(array(
            'error'     => false,
            "message" => "Solar created successfully",
        ));   
       }
       }
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

    /* Update the solar system  */
    public function update(Request $request, $id)
    {
      $input = $request->all();
      $findDuplicate=Solar_model::where('name',$request->input('name'))->first();
      if(count($findDuplicate)>0){
          if($findDuplicate->id==$id){
          $update=Solar_model::where('id', $id)
                ->update($input);
          $response=array(
            'error'     => false,
            "message" => "Solar successfully updated",
                ); 
          }else{
        $response=array(
            'error'     => true,
            "message" => 'Solar name already exist',
        );  
              
          }
      
      }else{
         $update=Solar_model::where('id', $id)->update($input);
        if(!$update){
        $response=array(
            'error'     => true,
            "message" => 'Some Error',
			);   
      }else{
          $response=array(
            'error'     => false,
            "message" => "Solar successfully updated",
        ); 
              
          }
      }
          return Response::json($response);
      }
	
     /* Delete the solar system  */
    public function destroy($id)
    {
    $delete= Solar_model::where('id', $id)->delete();
	if($delete){
	 $response=array(
            'error'     => false,
            "message" => "Successfully deleted",
        ); 	
	}else{
		 $response=array(
           'error'     => true,
            "message" => "Some Error",
        ); 
	}
	   return Response::json($response);
    }
	
	
}
