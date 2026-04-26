<?php

namespace App\Infrastructure\TypeGender\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeGender extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_gender";
	protected $entity		= "TYPE-GENDER";
	protected $primaryKey 	= "Id_TypeGender";
	protected $fillable 	= [
		"Id_TypeGender",
		"TypeGender_Name",
		"TypeGender_Abrv",
		"TypeGender_Public",
		"TypeGender_Status"
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