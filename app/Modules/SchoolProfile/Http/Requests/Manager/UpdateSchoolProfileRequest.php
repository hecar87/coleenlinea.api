<?php

namespace App\Modules\SchoolProfile\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolProfileRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolProfile"			=> "required|int",
			"SchoolProfile_Number"		=> "required|string|max:50",
			"SchoolProfile_CCI"			=> "required|string|max:50",
			"SchoolProfile_Remark"		=> "required|string|max:250",
			"SchoolProfile_Public"		=> "required|int|in:1,2",
			"SchoolProfile_Status"		=> "required|int|in:1,2",
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