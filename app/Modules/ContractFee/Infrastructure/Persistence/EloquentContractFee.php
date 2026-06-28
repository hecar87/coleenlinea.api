<?php

namespace App\Modules\ContractFee\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentContractFee extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_ContractFee";
	protected $fillable 	= [
		"Id_ContractFee",
		"ContractFee_Number",
		"ContractFee_CCI",
		"ContractFee_Remark",
		"ContractFee_Default",
		"ContractFee_Public",
		"ContractFee_Status",
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