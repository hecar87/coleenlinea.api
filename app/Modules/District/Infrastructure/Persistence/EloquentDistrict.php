<?php

namespace App\Modules\District\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentDistrict extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_district";
	protected $entity		= "DISTRICT";
	protected $primaryKey 	= "Id_District";
	protected $fillable 	= [
		"Id_District",
		"District_Code",
		"District_Name",
		"District_Public",
		"District_Status",
		"Id_City"
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