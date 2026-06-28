<?php

namespace App\Modules\ContractFee\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateContractFeeRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"ContractFee_Number"		=> "required|string|max:50",
			"ContractFee_CCI"			=> "required|string|max:50",
			"ContractFee_Remark"		=> "required|string|max:250",
			"ContractFee_Public"		=> "required|int|in:1,2",
			"ContractFee_Status"		=> "required|int|in:1,2",
			"Id_School"					=> "required|int",
			"Id_TypeBank"				=> "required|int",
			"Id_TypeCurrency"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}