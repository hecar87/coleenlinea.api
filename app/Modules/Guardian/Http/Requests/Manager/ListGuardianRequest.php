<?php

namespace App\Modules\Guardian\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListGuardianRequest extends ValidatedRequest
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