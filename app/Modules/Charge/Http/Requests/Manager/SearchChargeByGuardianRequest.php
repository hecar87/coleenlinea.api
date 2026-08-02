<?php

namespace App\Modules\Charge\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class SearchChargeByGuardianRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			//"Text"				=> "string",
			"Status"			=> "required|string|max:50|in:ALL,ACTIVE,INACTIVE,NULLIFIED",
			"Page_Size"			=> "required|int|min:1",
			"Page_Current"		=> "required|int|min:1"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}