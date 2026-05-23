<?php

namespace App\Modules\School\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_School"			=> "required|int",
			"School_Code"		=> "required|string|max:2",
			"School_Name"		=> "required|string|max:250",
			"School_Abrv"		=> "required|string|max:4",
			"School_Public"		=> "required|int|in:1,2",
			"School_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}