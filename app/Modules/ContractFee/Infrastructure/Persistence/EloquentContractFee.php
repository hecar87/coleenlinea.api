<?php

namespace App\Modules\ContractFee\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentContractFee extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_contract_fee";
	protected $entity		= "CONTRACT-FEE";
	protected $primaryKey 	= "Id_ContractFee";
	protected $fillable 	= [
		"Id_ContractFee",
		"ContractFee_Fee_Amount",
		"ContractFee_Fee_Percentage",
		"ContractFee_Fee_Payer",
		"ContractFee_Remark",
		"Id_Contract",
		"Id_TypeCurrency",
		"Id_TypeFee"
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