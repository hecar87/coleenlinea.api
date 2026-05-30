<?php

namespace App\Modules\SchoolAccount\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolAccount extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_state";
	protected $entity		= "STATE";
	protected $primaryKey 	= "Id_SchoolAccount";
	protected $fillable 	= [
		"Id_SchoolAccount",
		"SchoolAccount_Code",
		"SchoolAccount_Name",
		"SchoolAccount_Abrv",
		"SchoolAccount_Public",
		"SchoolAccount_Status"
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