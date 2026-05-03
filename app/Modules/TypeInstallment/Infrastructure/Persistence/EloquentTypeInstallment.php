<?php

namespace App\Modules\TypeInstallment\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentTypeInstallment extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_type_installment";
	protected $entity		= "TYPE-INSTALLMENT";
	protected $primaryKey 	= "Id_TypeInstallment";
	protected $fillable 	= [
		"Id_TypeInstallment",
		"TypeInstallment_Name",
		"TypeInstallment_Abrv",
		"TypeInstallment_Public",
		"TypeInstallment_Status"
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