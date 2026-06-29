<?php

namespace App\Modules\Guardian\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateGuardianRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Guardian"			=> "required|int",
			"Guardian_Name"			=> "required|string|max:100",
			"Guardian_LastName"		=> "required|string|max:100",
			"Guardian_NoDocument"	=> "required|string|max:100",
			"Guardian_DOB"			=> "required|string",
			"Id_TypeDocument"		=> "required|int",
			"Id_TypeGender"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}