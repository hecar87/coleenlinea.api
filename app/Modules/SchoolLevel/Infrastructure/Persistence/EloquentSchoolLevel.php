<?php

namespace App\Modules\SchoolLevel\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolLevel extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_SchoolLevel";
	protected $fillable 	= [
		"Id_SchoolLevel",
		"SchoolLevel_Number",
		"SchoolLevel_CCI",
		"SchoolLevel_Remark",
		"SchoolLevel_Default",
		"SchoolLevel_Public",
		"SchoolLevel_Status",
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