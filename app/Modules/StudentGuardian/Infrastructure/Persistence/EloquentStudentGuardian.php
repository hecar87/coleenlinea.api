<?php

namespace App\Modules\StudentGuardian\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentStudentGuardian extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_StudentGuardian";
	protected $fillable 	= [
		"Id_StudentGuardian",
		"StudentGuardian_Number",
		"StudentGuardian_CCI",
		"StudentGuardian_Remark",
		"StudentGuardian_Default",
		"StudentGuardian_Public",
		"StudentGuardian_Status",
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