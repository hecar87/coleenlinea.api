<?php

namespace App\Modules\SchoolAccount\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolAccount extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_SchoolAccount";
	protected $fillable 	= [
		"Id_SchoolAccount",
		"SchoolAccount_Number",
		"SchoolAccount_CCI",
		"SchoolAccount_Remark",
		"SchoolAccount_Default",
		"SchoolAccount_Public",
		"SchoolAccount_Status",
		"Id_School",
		"Id_TypeBank",
		"Id_TypeCurrency"
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