<?php

namespace App\Modules\School\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchool extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_state";
	protected $entity		= "STATE";
	protected $primaryKey 	= "Id_School";
	protected $fillable 	= [
		"Id_School",
		"School_Code",
		"School_Name",
		"School_Abrv",
		"School_Public",
		"School_Status"
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