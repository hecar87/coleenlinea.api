<?php

namespace App\Modules\StudentGuardian\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentStudentGuardian extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_student_guardian";
	protected $entity		= "STUDENT-GUARDIAN";
	protected $primaryKey 	= "Id_StudentGuardian";
	protected $fillable 	= [
		"Id_StudentGuardian",
		"StudentGuardian_Date_Start",
		"StudentGuardian_Date_End",
		"StudentGuardian_Verified",
		"StudentGuardian_Status",
		"Id_Student",
		"Id_Guardian",
		"Id_TypeKinship"
	];
	protected $hidden 		= [];
	protected $casts 		= [
		"StudentGuardian_Date_Start"	=> "datetime:c",
		"StudentGuardian_Date_End"		=> "datetime:c",
	];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}