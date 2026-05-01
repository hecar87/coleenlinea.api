<?php

namespace App\Modules\TypeCivil\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeCivilRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeCivil"			=> "required|int",
			"TypeCivil_Code"		=> "required|string|max:2",
			"TypeCivil_Name"		=> "required|string|max:250",
			"TypeCivil_Abrv"		=> "required|string|max:4",
			"TypeCivil_Public"		=> "required|int|in:1,2",
			"TypeCivil_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}