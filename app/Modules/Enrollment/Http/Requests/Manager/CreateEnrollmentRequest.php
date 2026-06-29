<?php

namespace App\Modules\Enrollment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateEnrollmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Enrollment_Number"		=> "required|string|max:50",
			"Enrollment_CCI"			=> "required|string|max:50",
			"Enrollment_Remark"		=> "required|string|max:250",
			"Enrollment_Public"		=> "required|int|in:1,2",
			"Enrollment_Status"		=> "required|int|in:1,2",
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