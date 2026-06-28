<?php

namespace App\Modules\ContractFee\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateContractFeeRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_ContractFee"			=> "required|int",
			"ContractFee_Fee_Amount"		=> "required|numeric",
			"ContractFee_Fee_Percentage"	=> "required|numeric",
			"ContractFee_Fee_Payer"			=> "required|int",
			"ContractFee_Remark" 			=> "required|string|max:250",
			"Id_Contract"					=> "required|int",
			"Id_TypeCurrency"				=> "required|int",
			"Id_TypeFee"					=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}