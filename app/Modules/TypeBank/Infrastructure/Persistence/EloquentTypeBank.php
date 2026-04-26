<?php

namespace App\Infrastructure\TypeBank\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeBank extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_bank";
	protected $entity		= "TYPE-BANK";
	protected $primaryKey 	= "Id_TypeBank";
	protected $fillable 	= [
		"Id_TypeBank",
		"TypeBank_Code",
		"TypeBank_Name",
		"TypeBank_Abrv",
		"TypeBank_Public",
		"TypeBank_Status"
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