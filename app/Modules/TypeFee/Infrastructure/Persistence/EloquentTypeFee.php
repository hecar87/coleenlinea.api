<?php

namespace App\Modules\TypeFee\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeFee extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_fee";
	protected $entity		= "TYPE-FEE";
	protected $primaryKey 	= "Id_TypeFee";
	protected $fillable 	= [
		"Id_TypeFee",
		"TypeFee_Name",
		"TypeFee_Abrv",
		"TypeFee_Public",
		"TypeFee_Status"
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