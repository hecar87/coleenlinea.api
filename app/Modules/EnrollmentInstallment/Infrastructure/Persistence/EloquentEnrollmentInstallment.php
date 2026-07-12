<?php

namespace App\Modules\EnrollmentInstallment\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentEnrollmentInstallment extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_enrollment_installment";
	protected $entity		= "ENROLLMENT-INSTALLMENT";
	protected $primaryKey 	= "Id_EnrollmentInstallment";
	protected $fillable 	= [
		"Id_EnrollmentInstallment",
		"EnrollmentInstallment_Date_Created",
		"EnrollmentInstallment_Date_Paid",
		"EnrollmentInstallment_Date_Nullified",
		"EnrollmentInstallment_Order",
		"EnrollmentInstallment_Description",
		"EnrollmentInstallment_Amount_Budgeted",
		"EnrollmentInstallment_Amount_Discounted",
		"EnrollmentInstallment_Amount_Payabled",
		"EnrollmentInstallment_Date_Collection",
		"EnrollmentInstallment_Date_Due",
		"EnrollmentInstallment_Required",
		"EnrollmentInstallment_Paid",
		"EnrollmentInstallment_Status",
		"Id_Charge",
		"Id_Enrollment",
		"Id_TypeCurrency",
		"Id_TypeInstallment"
	];
	protected $hidden 		= [];
	protected $casts 		= [
		"EnrollmentInstallment_Date_Created"	=> "datetime:c",
		"EnrollmentInstallment_Date_Paid"		=> "datetime:c",
		"EnrollmentInstallment_Date_Nullified"	=> "datetime:c"
	];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}