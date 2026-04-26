<?php

namespace App\Infrastructure\City\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentCity extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_city";
	protected $entity		= "CITY";
	protected $primaryKey 	= "Id_City";
	protected $fillable 	= [
		"Id_City",
		"City_Code",
		"City_Name",
		"City_Public",
		"City_Status",
		"Id_State"
	];
	protected $hidden 		= [];
	protected $casts 		= [];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}