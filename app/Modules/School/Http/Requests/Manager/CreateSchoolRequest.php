<?php

namespace App\Modules\School\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateSchoolRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"School_Code"			=> "required|string|max:20",
			"School_BusinessName"	=> "required|string|max:200",
			"School_TradeName"		=> "required|string|max:200",
			"School_NoDocument"		=> "required|string|max:30",
			"School_Address"		=> "required|string|max:250",
			"School_Phone"			=> "required|string|max:30",
			"School_Public"			=> "required|int|in:1,2",
			"School_Status"			=> "required|int|in:1,2",
			"Id_State"				=> "required|int",
			"Id_City"				=> "required|int",
			"Id_District"			=> "required|int",
			"Id_TypeDocument"		=> "required|int",
			"Id_TypePopulation"		=> "required|int",
			"Id_TypeSchool"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}