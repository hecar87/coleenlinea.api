<?php

namespace App\Modules\SchoolProfile\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class SearchSchoolProfileRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			//"Text"				=> "string",
			"Status"			=> "required|string|max:50|in:ALL,ACTIVE,INACTIVE",
			"Page_Size"			=> "required|int|min:1",
			"Page_Current"		=> "required|int|min:1"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}