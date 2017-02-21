<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Planet_model;
use App\Model\Solar_model;
use Response;

class SolarplanetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $response['result']=Planet_model::get();
	if(count($response['result'])==0){
		$message= "No Planet list found";
	  }else{
		$message="Planet List Returned"; 
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

    /* Store the Planet system  */
    public function store(Request $request)
    {
       $findDuplicate=Planet_model::where('name',$request->input('name'))->where('solar_system_id',$request->input('solar_system_id'))->first();
	   $data=array('name'    => $request->input('name'),
					'solar_system_id'	=> $request->input('solar_system_id'),
					'size'				=> $request->input('size'),
                    'coordinate_x'		=> $request->input('coordinate_x'),
                    'coordinate_y'		=> $request->input('coordinate_y'),
                    'coordinate_z'		=> $request->input('coordinate_z'),
                    'isSun'				=> $request->input('isSun'),
                    'isOrbitSun'		=> $request->input('isOrbitSun'));
					
       if(count($findDuplicate)>0){
      $response=array(
            'error'     => false,
            "message" => "Planet allready exist",
        ); 
       }else{
	  if($request->input('isSun')==1){
	  $findisSun=Planet_model::checkIssun($request->input('solar_system_id'),$request->input('isSun'));
	 // $findisSun=Planet_model::where('solar_system_id',$request->input('solar_id'))->where('isSun',1)->first();
	  if(count($findisSun)==0){
       $addSolar=Planet_model::create($data);
       if($addSolar){
           $response=array(
            'error'     => false,
            "message" => "Planet created successfully"
        );   
       }
	   }else{
		   $response=array(
            'error'     => true,
            "message" => "Sun already created in the planet"
        );    
	   }
	   }else{
		  $addSolar=Planet_model::create($data); 
		  $response=array(
            'error'     => false,
            "message" => "Planet created successfully"
        );    
	   }
	   }
	     return Response::json($response);
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

    /* Update the Planet system  */
    public function update(Request $request, $id)
    {
      $input = $request->all();
	  $data=array('name'    => $request->input('name'),
					'solar_system_id'	=> $request->input('solar_system_id'),
					'size'				=> $request->input('size'),
                    'coordinate_x'		=> $request->input('coordinate_x'),
                    'coordinate_y'		=> $request->input('coordinate_y'),
                    'coordinate_z'		=> $request->input('coordinate_z'),
                    'isSun'				=> $request->input('isSun'),
                    'isOrbitSun'		=> $request->input('isOrbitSun'));
					
	$findName=Planet_model::where('name',$request->input('name'))->where('solar_system_id',$request->input('solar_system_id'))->first();				
	$findID=Planet_model::where('id',$id)->first();
	if(count($findID)>0){
	if($findName['id']==$id){
		if($request->input('isSun')==1){
		$findisSun=Planet_model::checkIssun($findID['solar_system_id'],$request->input('isSun'));
		if(count($findisSun)>0){
			 $response=array(
            'error'     => false,
            "message" => "Sun already created in the planet",
                ); 
		}else{
			 $update=Planet_model::where('id', $id)
                ->update($data);
          $response=array(
            'error'     => false,
            "message" => "Planet successfully updated",
                ); 
		}
		}else{
			 $update=Planet_model::where('id', $id)
                ->update($data);
          $response=array(
            'error'     => false,
            "message" => "Planet successfully updated",
                ); 
		}
		
	}else{
		if(count($findName)>0){
		 $response=array(
            'error'     => false,
            "message" => "Planet Already Exist",
                ); 	
		}else{
		if($request->input('isSun')==1){
		$findisSun=Planet_model::checkIssun($findID['solar_system_id'],$request->input('isSun'));
		if(count($findisSun)>0){
			 $response=array(
            'error'     => false,
            "message" => "Sun Already created",
                ); 
		}else{
			 $update=Planet_model::where('id', $id)
                ->update($data);
          $response=array(
            'error'     => false,
            "message" => "Planet successfully updated",
                ); 
		}
		}else{
			 $update=Planet_model::where('id', $id)
                ->update($data);
          $response=array(
            'error'     => false,
            "message" => "Planet successfully updated",
                ); 
				}	
			}
		}
		
	}else{
		 $response=array(
            'error'     => true,
            "message" => "Invalid planet Id",
                ); 
	}
          return Response::json($response);
      }
	
     /* Delete the Planet system  */
    public function destroy($id)
    {
    $delete= Planet_model::where('id', $id)->where('id',$id)->delete();
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
	
	public function findSun(Request $request)
    {
	$findsolarId=Solar_model::where('id', $request->input('solar_id'))->first();
	$results=Planet_model::where('solar_system_id',$request->input('solar_id'))->where('isSun',1)->first();
	if(count($findsolarId)>0){
	   if(count($results)>0){
		   $message="Solar List Returned";
	   }else{
          $message="No solar list found";
	   }
		}else{
           $message= "Invalid Solar Id";
		}
	   	return Response::json(array(
            'error' 	=> false,
			"message" => $message,
			"response" => $results,
        ));
    }
	
	public function findOrbitSun(Request $request)
    {
		$findsunId=Planet_model::where('id', $request->input('sun_id'))->where('isSun',1)->first();
	    $results=array();
		if(count($findsunId)>0){
		$results=Planet_model::where('solar_system_id',$findsunId->solar_system_id)
							->where('isOrbitSun',1)
							->where('isSun','!=',1)
							->get();
			$message = "Solar List Returned";
			$error=false;
		}else{
			$error=true;
            $message = "Sun invalid / Not Found";
		}
		
	   	return Response::json(array(
            'error' 	=> $error,
			"message" => $message,
			"response" => $results,
        ));
    }
	
	public function findSolar(Request $request)
    {
	$findsolarId=Solar_model::where('id', $request->input('solar_id'))->first();
	$results=Planet_model::where('solar_system_id',$request->input('solar_id'))->where('isSun','!=',1)->first();
	if(count($findsolarId)>0){
	   if(count($results)>0){
		   $message="Solar List Returned";
		   $error=false;
	   }else{
          $message="No solar list found";
		  $error=false;
	   }
		}else{
           $message= "Invalid Solar Id";
		   $error=true;
		}
	   	return Response::json(array(
            'error' 	=> $error,
			"message" => $message,
			"response" => $results,
        ));
    }
	
	public function findSolarPlanetByName(Request $request)
    {
		$planet=Planet_model::select('solar_system_id')->where('name', $request->input('name'))->get()->toArray();
		$solar=Solar_model::select('id')->where('name', $request->input('name'))->get()->toArray();
	
		$result = array();
        if(count($planet) > 0 || count($solar) > 0)
        {
		$solarList=Solar_model::get();
		  $planet = array_map('current', $planet);
           $solar = array_map('current', $solar); 
		      if(count($solarList)>0)
            {
				foreach($solarList as $lst){
					       if(in_array($lst['id'],$solar) || in_array($lst['id'],$planet)){
							   $new_result=$lst;
							   $new_result['planets'] = array();
							   $planets=Planet_model::where('name', $request->input('name'))->where('solar_system_id', $lst['id'])->get();
							   if(count($planets)>0){
								 $new_result['planets']=$planets;  
							   }
							   $result[]=$new_result;
						   }
				}
			}
		}
		 	return Response::json(array(
            'error' 	=> false,
			"message" => "Search results",
			"response" => $result,
        ));
		 
    }
	
	public function findSolarPlanetBySize(Request $request)
    {
		$planet=Planet_model::select('solar_system_id')->where('size', $request->input('size'))->get()->toArray();
		$solar=Solar_model::select('id')->where('size', $request->input('size'))->get()->toArray();
	
		$result = array();
        if(count($planet) > 0 || count($solar) > 0)
        {
		$solarList=Solar_model::get();
		  $planet = array_map('current', $planet);
           $solar = array_map('current', $solar); 
		      if(count($solarList)>0)
            {
				foreach($solarList as $lst){
					       if(in_array($lst['id'],$solar) || in_array($lst['id'],$planet)){
							   $new_result=$lst;
							   $new_result['planets'] = array();
							   $planets=Planet_model::where('size', $request->input('size'))->where('solar_system_id', $lst['id'])->get();
							   if(count($planets)>0){
								 $new_result['planets']=$planets;  
							   }
							   $result[]=$new_result;
						   }
				}
			}
		}
		 	return Response::json(array(
            'error' 	=> false,
			"message" => "Search results",
			"response" => $result,
        ));
		 
    }
}
