<?php

namespace App\Modules\Contract\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateContractRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Contract_Number"		=> "required|string|max:50",
			"Contract_CCI"			=> "required|string|max:50",
			"Contract_Remark"		=> "required|string|max:250",
			"Contract_Public"		=> "required|int|in:1,2",
			"Contract_Status"		=> "required|int|in:1,2",
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