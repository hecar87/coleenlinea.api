<?php

namespace App\Modules\TypeCurrency\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeCurrency extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_currency";
	protected $entity		= "TYPE-CURRENCY";
	protected $primaryKey 	= "Id_TypeCurrency";
	protected $fillable 	= [
		"Id_TypeCurrency",
		"TypeCurrency_Code",
		"TypeCurrency_Name",
		"TypeCurrency_Symbol",
		"TypeCurrency_Public",
		"TypeCurrency_Status"
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