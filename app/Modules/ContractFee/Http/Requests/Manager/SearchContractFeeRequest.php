<?php

namespace App\Modules\ContractFee\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class SearchContractFeeRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			//"Text"				=> "string",
			"Page_Size"			=> "required|int|min:1",
			"Page_Current"		=> "required|int|min:1"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}