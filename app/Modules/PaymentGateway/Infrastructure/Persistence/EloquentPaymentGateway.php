<?php

namespace App\Modules\PaymentGateway\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentPaymentGateway extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_state";
	protected $entity		= "STATE";
	protected $primaryKey 	= "Id_PaymentGateway";
	protected $fillable 	= [
		"Id_PaymentGateway",
		"PaymentGateway_Code",
		"PaymentGateway_Name",
		"PaymentGateway_Abrv",
		"PaymentGateway_Public",
		"PaymentGateway_Status"
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