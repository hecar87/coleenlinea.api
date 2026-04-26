<?php

namespace App\Infrastructure\TypeCivil\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeCivil extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_civil";
	protected $entity		= "TYPE-CIVIL";
	protected $primaryKey 	= "Id_TypeCivil";
	protected $fillable 	= [
		"Id_TypeCivil",
		"TypeCivil_Name",
		"TypeCivil_Abrv",
		"TypeCivil_Public",
		"TypeCivil_Status"
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