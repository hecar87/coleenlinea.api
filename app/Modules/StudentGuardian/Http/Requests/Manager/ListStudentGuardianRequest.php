<?php

namespace App\Modules\StudentGuardian\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListStudentGuardianRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Display"	=> "required|string|max:50|in:ALL,PUBLIC,PRIVATE"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}