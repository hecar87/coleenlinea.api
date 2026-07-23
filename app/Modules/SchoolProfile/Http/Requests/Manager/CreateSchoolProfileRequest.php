<?php

namespace App\Modules\SchoolProfile\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateSchoolProfileRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"SchoolProfile_Name"			=> "required|string|max:150",
			"SchoolProfile_Description"		=> "required|string|max:250",
			"SchoolProfile_Newed"			=> "required|int|in:1,2",
			"SchoolProfile_Type"			=> "required|int|in:1,2",
			"SchoolProfile_Status"			=> "required|int|in:1,2",
			"Id_School"						=> "required|int",
			"Id_SchoolYear"					=> "required|int",
			"Id_SchoolLevel"				=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}