<?php

namespace App\Modules\TypeGender\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeGenderRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeGender"			=> "required|int",
			"TypeGender_Code"		=> "required|string|max:2",
			"TypeGender_Name"		=> "required|string|max:250",
			"TypeGender_Abrv"		=> "required|string|max:4",
			"TypeGender_Public"		=> "required|int|in:1,2",
			"TypeGender_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}