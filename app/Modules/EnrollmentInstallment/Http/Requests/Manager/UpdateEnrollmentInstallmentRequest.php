<?php

namespace App\Modules\EnrollmentInstallment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateEnrollmentInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_EnrollmentInstallment"			=> "required|int",
			"EnrollmentInstallment_Number"		=> "required|string|max:50",
			"EnrollmentInstallment_CCI"			=> "required|string|max:50",
			"EnrollmentInstallment_Remark"		=> "required|string|max:250",
			"EnrollmentInstallment_Public"		=> "required|int|in:1,2",
			"EnrollmentInstallment_Status"		=> "required|int|in:1,2",
			"Id_School"					=> "required|int",
			"Id_TypeBank"				=> "required|int",
			"Id_TypeCurrency"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}