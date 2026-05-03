<?php

namespace App\Modules\TypeDocument\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeDocument extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_document";
	protected $entity		= "TYPE-DOCUMENT";
	protected $primaryKey 	= "Id_TypeDocument";
	protected $fillable 	= [
		"Id_TypeDocument",
		"TypeDocument_Name",
		"TypeDocument_Abrv",
		"TypeDocument_Public",
		"TypeDocument_Status"
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