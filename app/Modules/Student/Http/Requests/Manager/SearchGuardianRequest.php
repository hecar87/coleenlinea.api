<?php

namespace App\Modules\Guardian\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class SearchGuardianRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			//"Text"				=> "string",
			"Verified"			=> "required|string|max:50|in:ALL,PENDING,VERIFIED",
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