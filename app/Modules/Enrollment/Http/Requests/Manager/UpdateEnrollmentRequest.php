<?php

namespace App\Modules\Enrollment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateEnrollmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Enrollment"			=> "required|int",
			"Enrollment_Type"		=> "required|int|in:1,2",
			"Enrollment_Newed"		=> "required|int|in:1,2",
			"Id_School"				=> "required|int",
			"Id_SchoolYear"			=> "required|int",
			"Id_SchoolClass"		=> "required|int",
			"Id_Student"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}