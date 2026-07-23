<?php

namespace App\Modules\SchoolProfile\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolProfile extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_SchoolProfile";
	protected $fillable 	= [
		"Id_SchoolProfile",
		"SchoolProfile_Number",
		"SchoolProfile_CCI",
		"SchoolProfile_Remark",
		"SchoolProfile_Default",
		"SchoolProfile_Public",
		"SchoolProfile_Status",
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