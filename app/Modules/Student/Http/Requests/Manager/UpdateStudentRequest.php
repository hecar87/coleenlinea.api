<?php

namespace App\Modules\Student\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateStudentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Student"			=> "required|int",
			"Student_Name"			=> "required|string|max:100",
			"Student_LastName"		=> "required|string|max:100",
			"Student_NoDocument"	=> "required|string|max:100",
			"Student_DOB"			=> "required|string",
			"Id_TypeDocument"		=> "required|int",
			"Id_TypeGender"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}