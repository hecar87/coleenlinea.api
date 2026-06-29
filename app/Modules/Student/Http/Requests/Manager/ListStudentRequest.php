<?php

namespace App\Modules\Student\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListStudentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Verified"	=> "required|string|max:50|in:ALL,PENDING,VERIFIED",
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}