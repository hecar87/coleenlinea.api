<?php

namespace App\Infrastructure\TypeSchool\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeSchool extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_school";
	protected $entity		= "TYPE-SCHOOL";
	protected $primaryKey 	= "Id_TypeSchool";
	protected $fillable 	= [
		"Id_TypeSchool",
		"TypeSchool_Name",
		"TypeSchool_Abrv",
		"TypeSchool_Public",
		"TypeSchool_Status"
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