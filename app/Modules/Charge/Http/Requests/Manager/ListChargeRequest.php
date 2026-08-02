<?php

namespace App\Modules\Charge\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListChargeRequest extends ValidatedRequest
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