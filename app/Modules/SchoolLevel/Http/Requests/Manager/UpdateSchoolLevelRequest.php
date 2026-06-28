<?php

namespace App\Modules\SchoolLevel\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolLevelRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolLevel"			=> "required|int",
			"SchoolLevel_Code"			=> "required|string|max:50",
			"SchoolLevel_Shift"			=> "required|string|max:250",
			"SchoolLevel_Public"		=> "required|int|in:1,2",
			"SchoolLevel_Status"		=> "required|int|in:1,2",
			"Id_School"					=> "required|int",
			"Id_TypeLevel"				=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}