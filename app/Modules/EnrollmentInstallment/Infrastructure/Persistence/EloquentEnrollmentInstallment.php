<?php

namespace App\Modules\EnrollmentInstallment\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentEnrollmentInstallment extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_school_account";
	protected $entity		= "SCHOOL-ACCOUNT";
	protected $primaryKey 	= "Id_EnrollmentInstallment";
	protected $fillable 	= [
		"Id_EnrollmentInstallment",
		"EnrollmentInstallment_Number",
		"EnrollmentInstallment_CCI",
		"EnrollmentInstallment_Remark",
		"EnrollmentInstallment_Default",
		"EnrollmentInstallment_Public",
		"EnrollmentInstallment_Status",
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