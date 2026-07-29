<?php

namespace App\Modules\Charge\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentCharge extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school";
	protected $entity		= "SCHOOL";
	protected $primaryKey 	= "Id_Charge";
	protected $fillable 	= [
		"Id_Charge",
		"Charge_Code",
		"Charge_BusinessName",
		"Charge_TradeName",
		"Charge_NoDocument",
		"Charge_Address",
		"Charge_Phone",
		"Charge_Public",
		"Charge_Status",
		"Id_State",
		"Id_City",
		"Id_District",
		"Id_TypeDocument",
		"Id_TypePopulation",
		"Id_TypeCharge"
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