<?php

namespace App\Modules\SchoolLevel\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolLevel extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_level";
	protected $entity		= "SCHOOL-LEVEL";
	protected $primaryKey 	= "Id_SchoolLevel";
	protected $fillable 	= [
		"Id_SchoolLevel",
		"SchoolLevel_Code",
		"SchoolLevel_Shift",
		"SchoolLevel_Public",
		"SchoolLevel_Status",
		"Id_School",
		"Id_TypeLevel"
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