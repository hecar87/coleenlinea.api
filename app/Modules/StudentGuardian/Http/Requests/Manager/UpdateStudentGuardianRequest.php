<?php

namespace App\Modules\StudentGuardian\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateStudentGuardianRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_StudentGuardian"			=> "required|int",
			"StudentGuardian_Number"		=> "required|string|max:50",
			"StudentGuardian_CCI"			=> "required|string|max:50",
			"StudentGuardian_Remark"		=> "required|string|max:250",
			"StudentGuardian_Public"		=> "required|int|in:1,2",
			"StudentGuardian_Status"		=> "required|int|in:1,2",
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