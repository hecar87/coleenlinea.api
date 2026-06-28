<?php

namespace App\Modules\Contract\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListContractRequest extends ValidatedRequest
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