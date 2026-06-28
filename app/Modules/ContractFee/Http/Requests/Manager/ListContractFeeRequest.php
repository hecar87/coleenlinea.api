<?php

namespace App\Modules\ContractFee\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListContractFeeRequest extends ValidatedRequest
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