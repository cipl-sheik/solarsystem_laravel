<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Solar_model extends Model
{	 protected $table = 'solar_system';
     protected $fillable = [
        'name', 'size','coordinate_x', 'coordinate_y','coordinate_z'
    ];
}
