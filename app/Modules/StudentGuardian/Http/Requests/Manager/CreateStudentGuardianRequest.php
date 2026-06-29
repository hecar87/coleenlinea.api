<?php

namespace App\Modules\StudentGuardian\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateStudentGuardianRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Student"			=> "required|int",
			"Id_Guardian"			=> "required|int",
			"Id_TypeKinship"		=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}