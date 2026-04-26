<?php

namespace App\Infrastructure\TypeLevel\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeLevel extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_level";
	protected $entity		= "TYPE-LEVEL";
	protected $primaryKey 	= "Id_TypeLevel";
	protected $fillable 	= [
		"Id_TypeLevel",
		"TypeLevel_Name",
		"TypeLevel_Abrv",
		"TypeLevel_Public",
		"TypeLevel_Status"
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