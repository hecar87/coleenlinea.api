<?php

namespace App\Modules\Guardian\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentGuardian extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_guardian";
	protected $entity		= "GUARDIAN";
	protected $primaryKey 	= "Id_Guardian";
	protected $fillable 	= [
		"Id_Guardian",
		"Guardian_Date_Created",
		"Guardian_Date_Updated",
		"Guardian_Date_Deleted",
		"Guardian_Date_Verified",
		"Guardian_Code",
		"Guardian_Name",
		"Guardian_LastName",
		"Guardian_NoDocument",
		"Guardian_DOB",
		"Guardian_Verified",
		"Guardian_Status",
		"Id_TypeDocument",
		"Id_TypeGender",
	];
	protected $hidden 		= [];
	protected $casts 		= [
		"Guardian_Date_Updated"		=> "datetime:c",
		"Guardian_Date_Deleted"		=> "datetime:c",
		"Guardian_Date_Created"		=> "datetime:c",
		"Guardian_Date_Verified"	=> "datetime:c"
	];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}