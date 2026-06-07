<?php

namespace App\Modules\SchoolBranch\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolBranch extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_branch";
	protected $entity		= "SCHOOL-BRANCH";
	protected $primaryKey 	= "Id_SchoolBranch";
	protected $fillable 	= [
		"SchoolBranch_Code",
		"SchoolBranch_Name",
		"SchoolBranch_Address",
		"SchoolBranch_Phone",
		"SchoolBranch_LAT",
		"SchoolBranch_LNG",
		"SchoolBranch_Public",
		"SchoolBranch_Status",
		"Id_School",
		"Id_State",
		"Id_City",
		"Id_District"
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