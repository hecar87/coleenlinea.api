<?php

namespace App\Modules\School\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchool extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school";
	protected $entity		= "SCHOOL";
	protected $primaryKey 	= "Id_School";
	protected $fillable 	= [
		"Id_School",
		"School_Code",
		"School_BusinessName",
		"School_TradeName",
		"School_NoDocument",
		"School_Address",
		"School_Phone",
		"School_Public",
		"School_Status",
		"Id_State",
		"Id_City",
		"Id_District",
		"Id_TypeDocument",
		"Id_TypePopulation",
		"Id_TypeSchool"
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