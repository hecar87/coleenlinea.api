<?php

namespace App\Modules\Student\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentStudent extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_student";
	protected $entity		= "STUDENT";
	protected $primaryKey 	= "Id_Student";
	protected $fillable 	= [
		"Id_Student",
		"Student_Date_Created",
		"Student_Date_Updated",
		"Student_Date_Deleted",
		"Student_Date_Verified",
		"Student_Code",
		"Student_Name",
		"Student_LastName",
		"Student_NoDocument",
		"Student_DOB",
		"Student_Verified",
		"Student_Status",
		"Id_TypeDocument",
		"Id_TypeGender",
	];
	protected $hidden 		= [];
	protected $casts 		= [
		"Student_Date_Updated"		=> "datetime:c",
		"Student_Date_Deleted"		=> "datetime:c",
		"Student_Date_Created"		=> "datetime:c",
		"Student_Date_Verified"		=> "datetime:c"
	];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}