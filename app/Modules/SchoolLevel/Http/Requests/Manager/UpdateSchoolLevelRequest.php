<?php

namespace App\Modules\SchoolLevel\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolLevelRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolLevel"			=> "required|int",
			"SchoolLevel_Number"		=> "required|string|max:50",
			"SchoolLevel_CCI"			=> "required|string|max:50",
			"SchoolLevel_Remark"		=> "required|string|max:250",
			"SchoolLevel_Public"		=> "required|int|in:1,2",
			"SchoolLevel_Status"		=> "required|int|in:1,2",
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