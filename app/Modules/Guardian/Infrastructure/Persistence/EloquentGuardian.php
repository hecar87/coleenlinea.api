<?php

namespace App\Modules\Guardian\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentGuardian extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school";
	protected $entity		= "SCHOOL";
	protected $primaryKey 	= "Id_Guardian";
	protected $fillable 	= [
		"Id_Guardian",
		"Guardian_Code",
		"Guardian_BusinessName",
		"Guardian_TradeName",
		"Guardian_NoDocument",
		"Guardian_Address",
		"Guardian_Phone",
		"Guardian_Public",
		"Guardian_Status",
		"Id_State",
		"Id_City",
		"Id_District",
		"Id_TypeDocument",
		"Id_TypePopulation",
		"Id_TypeGuardian"
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