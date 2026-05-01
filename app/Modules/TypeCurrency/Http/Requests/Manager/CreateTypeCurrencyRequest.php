<?php

namespace App\Modules\TypeCurrency\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateTypeCurrencyRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"TypeCurrency_Code"		=> "required|string|max:2",
			"TypeCurrency_Name"		=> "required|string|max:250",
			"TypeCurrency_Abrv"		=> "required|string|max:4",
			"TypeCurrency_Public"	=> "required|int|in:1,2",
			"TypeCurrency_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}