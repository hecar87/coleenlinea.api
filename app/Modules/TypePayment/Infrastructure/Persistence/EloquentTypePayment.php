<?php

namespace App\modules\TypePayment\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypePayment extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_payment";
	protected $entity		= "TYPE-PAYMENT";
	protected $primaryKey 	= "Id_TypePayment";
	protected $fillable 	= [
		"Id_TypePayment",
		"TypePayment_Name",
		"TypePayment_Abrv",
		"TypePayment_Public",
		"TypePayment_Status"
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