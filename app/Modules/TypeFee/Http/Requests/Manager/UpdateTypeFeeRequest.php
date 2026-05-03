<?php

namespace App\Modules\TypeFee\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeFeeRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeFee"		=> "required|int",
			"TypeFee_Code"		=> "required|string|max:2",
			"TypeFee_Name"		=> "required|string|max:250",
			"TypeFee_Abrv"		=> "required|string|max:4",
			"TypeFee_Public"	=> "required|int|in:1,2",
			"TypeFee_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}