<?php

namespace App\Modules\Enrollment\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentEnrollment extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_Enrollment";
	protected $fillable 	= [
		"Id_Enrollment",
		"Enrollment_Number",
		"Enrollment_CCI",
		"Enrollment_Remark",
		"Enrollment_Default",
		"Enrollment_Public",
		"Enrollment_Status",
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