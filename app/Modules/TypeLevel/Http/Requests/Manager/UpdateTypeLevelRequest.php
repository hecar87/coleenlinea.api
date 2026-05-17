<?php

namespace App\Modules\TypeLevel\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeLevelRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeLevel"			=> "required|int",
			"TypeLevel_Code"		=> "required|string|max:2",
			"TypeLevel_Name"		=> "required|string|max:250",
			"TypeLevel_Abrv"		=> "required|string|max:4",
			"TypeLevel_Public"		=> "required|int|in:1,2",
			"TypeLevel_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}