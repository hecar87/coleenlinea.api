<?php

namespace App\Modules\SchoolBranch\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolBranch extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_SchoolBranch";
	protected $fillable 	= [
		"Id_SchoolBranch",
		"SchoolBranch_Number",
		"SchoolBranch_CCI",
		"SchoolBranch_Remark",
		"SchoolBranch_Default",
		"SchoolBranch_Public",
		"SchoolBranch_Status",
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