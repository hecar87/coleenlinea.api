<?php

namespace App\Modules\SchoolAccount\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolAccountRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolAccount"			=> "required|int",
			"SchoolAccount_Code"		=> "required|string|max:2",
			"SchoolAccount_Name"		=> "required|string|max:250",
			"SchoolAccount_Abrv"		=> "required|string|max:4",
			"SchoolAccount_Public"		=> "required|int|in:1,2",
			"SchoolAccount_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}