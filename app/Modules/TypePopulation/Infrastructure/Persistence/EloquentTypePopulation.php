<?php

namespace App\Modules\TypePopulation\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypePopulation extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_population";
	protected $entity		= "TYPE-POPULATION";
	protected $primaryKey 	= "Id_TypePopulation";
	protected $fillable 	= [
		"Id_TypePopulation",
		"TypePopulation_Name",
		"TypePopulation_Abrv",
		"TypePopulation_Public",
		"TypePopulation_Status"
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