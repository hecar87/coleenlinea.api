<?php

namespace App\Modules\City\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateCityRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_City"			=> "required|int",
			"City_Code"			=> "required|string|max:2",
			"City_Name"			=> "required|string|max:250",
			"City_Public"		=> "required|int|in:1,2",
			"City_Status"		=> "required|int|in:1,2",
			"Id_State"			=> "required|int",
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}