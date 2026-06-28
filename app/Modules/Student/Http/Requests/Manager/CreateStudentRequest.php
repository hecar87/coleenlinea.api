<?php

namespace App\Modules\Student\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateStudentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Student_BusinessName"	=> "required|string|max:200",
			"Student_TradeName"		=> "required|string|max:200",
			"Student_NoDocument"		=> "required|string|max:30",
			"Student_Address"		=> "required|string|max:250",
			"Student_Phone"			=> "required|string|max:30",
			"Student_Public"			=> "required|int|in:1,2",
			"Student_Status"			=> "required|int|in:1,2",
			"Id_State"				=> "required|int",
			"Id_City"				=> "required|int",
			"Id_District"			=> "required|int",
			"Id_TypeDocument"		=> "required|int",
			"Id_TypePopulation"		=> "required|int",
			"Id_TypeStudent"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}