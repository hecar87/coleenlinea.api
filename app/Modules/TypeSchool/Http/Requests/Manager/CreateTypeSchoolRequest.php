<?php

namespace App\Modules\TypeSchool\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateTypeSchoolRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"TypeSchool_Code"		=> "required|string|max:2",
			"TypeSchool_Name"		=> "required|string|max:250",
			"TypeSchool_Abrv"		=> "required|string|max:4",
			"TypeSchool_Public"		=> "required|int|in:1,2",
			"TypeSchool_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}