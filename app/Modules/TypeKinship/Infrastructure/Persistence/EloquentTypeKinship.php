<?php

namespace App\Modules\TypeKinship\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeKinship extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_kinship";
	protected $entity		= "TYPE-KINSHIP";
	protected $primaryKey 	= "Id_TypeKinship";
	protected $fillable 	= [
		"Id_TypeKinship",
		"TypeKinship_Name",
		"TypeKinship_Abrv",
		"TypeKinship_Public",
		"TypeKinship_Status"
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