<?php

namespace App\Modules\SchoolClass\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolClass extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_class";
	protected $entity		= "SCHOOL-CLASS";
	protected $primaryKey 	= "Id_SchoolClass";
	protected $fillable 	= [
		"Id_SchoolClass",
		"SchoolClass_Name",
		"SchoolClass_Section",
		"SchoolClass_Public",
		"SchoolClass_Status",
		"Id_School",
		"Id_SchoolLevel"
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