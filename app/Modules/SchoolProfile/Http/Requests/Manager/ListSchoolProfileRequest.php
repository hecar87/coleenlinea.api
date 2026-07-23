<?php

namespace App\Modules\SchoolProfile\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListSchoolProfileRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}