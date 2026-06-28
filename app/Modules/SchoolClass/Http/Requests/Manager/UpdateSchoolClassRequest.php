<?php

namespace App\Modules\SchoolClass\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolClassRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolClass"			=> "required|int",
			"SchoolLevel_Code"			=> "required|string|max:250",
			"SchoolLevel_Shift"			=> "required|string|max:250",
			"SchoolLevel_Public"		=> "required|int|in:1,2",
			"SchoolLevel_Status"		=> "required|int|in:1,2",
			"Id_School"					=> "required|int",
			"Id_SchoolLevel"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}