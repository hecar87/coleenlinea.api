<?php

namespace App\Modules\SchoolProfile\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListSchoolProfileRequest extends ValidatedRequest
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