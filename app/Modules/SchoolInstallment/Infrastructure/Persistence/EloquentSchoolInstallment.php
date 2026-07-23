<?php

namespace App\Modules\SchoolInstallment\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentSchoolInstallment extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_installment";
	protected $entity		= "SCHOOL-INSTALLMENT";
	protected $primaryKey 	= "Id_SchoolInstallment";
	protected $fillable 	= [
		"Id_SchoolInstallment",
		"SchoolInstallment_Amount",
		"SchoolInstallment_Date_Start",
		"SchoolInstallment_Date_End",
		"SchoolInstallment_Required",
		"SchoolInstallment_Status",
		"Id_SchoolProfile",
		"Id_TypeCurrency",
		"Id_TypeInstallment"
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