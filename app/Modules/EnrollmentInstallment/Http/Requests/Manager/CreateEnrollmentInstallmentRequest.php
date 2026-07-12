<?php

namespace App\Modules\EnrollmentInstallment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateEnrollmentInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"EnrollmentInstallment_Order"				=> "required|int",
			"EnrollmentInstallment_Description"			=> "required|string|max:250",
			"EnrollmentInstallment_Amount_Budgeted"		=> "required|numeric",
			"EnrollmentInstallment_Amount_Discounted"	=> "required|numeric",
			"EnrollmentInstallment_Amount_Payabled"		=> "required|numeric",
			"EnrollmentInstallment_Date_Collection"		=> "required|string",
			"EnrollmentInstallment_Date_Due"			=> "required|string",
			"EnrollmentInstallment_Required"			=> "required|int|in:1,2",
			"Id_Enrollment"								=> "required|int",
			"Id_TypeCurrency"							=> "required|int",
			"Id_TypeInstallment"						=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}