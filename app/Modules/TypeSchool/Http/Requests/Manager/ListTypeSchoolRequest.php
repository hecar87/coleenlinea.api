<?php
namespace App\Http\Controllers\Manager\TypeSchool\Requests;

use App\Http\Requests\ValidatedRequest;

class ListTypeSchoolRequest extends ValidatedRequest
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