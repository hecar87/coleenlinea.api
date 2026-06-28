<?php

namespace App\Modules\SchoolYear\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolYear extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_year";
	protected $entity		= "SCHOOL-YEARS";
	protected $primaryKey 	= "Id_SchoolYear";
	protected $fillable 	= [
		"Id_SchoolYear",
		"SchoolYear_Name",
		"SchoolYear_Year",
		"SchoolYear_Date_Start",
		"SchoolYear_Date_End",
		"SchoolYear_Status",
		"Id_School"
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