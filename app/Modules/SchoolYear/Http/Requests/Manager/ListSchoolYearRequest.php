<?php

namespace App\Modules\SchoolYear\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListSchoolYearRequest extends ValidatedRequest
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