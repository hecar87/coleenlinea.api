<?php

namespace App\Modules\Guardian\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateGuardianRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Guardian_BusinessName"	=> "required|string|max:200",
			"Guardian_TradeName"		=> "required|string|max:200",
			"Guardian_NoDocument"		=> "required|string|max:30",
			"Guardian_Address"		=> "required|string|max:250",
			"Guardian_Phone"			=> "required|string|max:30",
			"Guardian_Public"			=> "required|int|in:1,2",
			"Guardian_Status"			=> "required|int|in:1,2",
			"Id_State"				=> "required|int",
			"Id_City"				=> "required|int",
			"Id_District"			=> "required|int",
			"Id_TypeDocument"		=> "required|int",
			"Id_TypePopulation"		=> "required|int",
			"Id_TypeGuardian"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}