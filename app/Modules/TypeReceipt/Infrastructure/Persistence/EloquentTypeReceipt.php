<?php

namespace App\Modules\TypeReceipt\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeReceipt extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_receipt";
	protected $entity		= "TYPE-RECEIPT";
	protected $primaryKey 	= "Id_TypeReceipt";
	protected $fillable 	= [
		"Id_TypeReceipt",
		"TypeReceipt_Name",
		"TypeReceipt_Abrv",
		"TypeReceipt_Public",
		"TypeReceipt_Status"
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