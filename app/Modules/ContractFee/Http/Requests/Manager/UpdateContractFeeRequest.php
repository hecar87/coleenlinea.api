<?php

namespace App\Modules\SchoolAccount\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolAccountRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolAccount"			=> "required|int",
			"SchoolAccount_Number"		=> "required|string|max:50",
			"SchoolAccount_CCI"			=> "required|string|max:50",
			"SchoolAccount_Remark"		=> "required|string|max:250",
			"SchoolAccount_Public"		=> "required|int|in:1,2",
			"SchoolAccount_Status"		=> "required|int|in:1,2",
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