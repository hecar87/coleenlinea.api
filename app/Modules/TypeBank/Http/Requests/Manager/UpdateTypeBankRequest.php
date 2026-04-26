<?php

namespace App\Modules\TypeBank\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeBankRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeBank"		=> "required|int",
			"TypeBank_Code"		=> "required|string|max:2",
			"TypeBank_Name"		=> "required|string|max:250",
			"TypeBank_Abrv"		=> "required|string|max:4",
			"TypeBank_Public"	=> "required|int|in:1,2",
			"TypeBank_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}