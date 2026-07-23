<?php

namespace App\Modules\SchoolProfile\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolProfile extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_profile";
	protected $entity		= "SCHOOL-PROFILE";
	protected $primaryKey 	= "Id_SchoolProfile";
	protected $fillable 	= [
		"Id_SchoolProfile",
		"SchoolProfile_Name",
		"SchoolProfile_Description",
		"SchoolProfile_Newed",
		"SchoolProfile_Type",
		"SchoolProfile_Status",
		"Id_School",
		"Id_SchoolYear",
		"Id_SchoolLevel",
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