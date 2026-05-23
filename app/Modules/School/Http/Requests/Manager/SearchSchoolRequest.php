<?php

namespace App\Modules\School\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class SearchSchoolRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			//"Text"				=> "string",
			"Display"			=> "required|string|max:50|in:ALL,PUBLIC,PRIVATE",
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