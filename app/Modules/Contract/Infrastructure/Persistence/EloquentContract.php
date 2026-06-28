<?php

namespace App\Modules\Contract\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentContract extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_Contract";
	protected $fillable 	= [
		"Id_Contract",
		"Contract_Number",
		"Contract_CCI",
		"Contract_Remark",
		"Contract_Default",
		"Contract_Public",
		"Contract_Status",
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