<?php

namespace App\Modules\Enrollment\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentEnrollment extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_enrollment";
	protected $entity		= "ENROLLMENT";
	protected $primaryKey 	= "Id_Enrollment";
	protected $fillable 	= [
		"Id_Enrollment",
		"Enrollment_Date_Created",
		"Enrollment_Date_Enrolled",
		"Enrollment_Date_Nullified",
		"Enrollment_Date_Start",
		"Enrollment_Date_End",
		"Enrollment_Code",
		"Enrollment_Type",
		"Enrollment_Newed",
		"Enrollment_Status",
		"Id_School",
		"Id_SchoolYear",
		"Id_SchoolClass",
		"Id_Student"
	];
	protected $hidden 		= [];
	protected $casts 		= [
		"Enrollment_Date_Created"	=> "datetime:c",
		"Enrollment_Date_Enrolled"	=> "datetime:c",
		"Enrollment_Date_Nullified"	=> "datetime:c"
	];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}