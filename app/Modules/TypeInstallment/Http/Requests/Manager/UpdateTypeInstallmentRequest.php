<?php

namespace App\Modules\TypeInstallment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeInstallment"		=> "required|int",
			"TypeInstallment_Name"		=> "required|string|max:250",
			"TypeInstallment_Abrv"		=> "required|string|max:4",
			"TypeInstallment_Frequency"	=> "required|int",
			"TypeInstallment_Public"	=> "required|int|in:1,2",
			"TypeInstallment_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}