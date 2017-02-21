<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Planet_model extends Model
{	 protected $table = 'solar_planet';
     protected $fillable = [
        'solar_system_id','name', 'size','coordinate_x', 'coordinate_y','coordinate_z','isSun','isOrbitSun'
    ];
	
public static function checkIssun($solar_id,$isSun)	
{
	 return DB::table('solar_planet')->where('solar_system_id',$solar_id)->where('isSun',$isSun)->first();
}
}
