<?php

namespace App\Modules\Student\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentStudent extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school";
	protected $entity		= "SCHOOL";
	protected $primaryKey 	= "Id_Student";
	protected $fillable 	= [
		"Id_Student",
		"Student_Code",
		"Student_BusinessName",
		"Student_TradeName",
		"Student_NoDocument",
		"Student_Address",
		"Student_Phone",
		"Student_Public",
		"Student_Status",
		"Id_State",
		"Id_City",
		"Id_District",
		"Id_TypeDocument",
		"Id_TypePopulation",
		"Id_TypeStudent"
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