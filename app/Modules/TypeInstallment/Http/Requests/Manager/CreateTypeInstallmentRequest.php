<?php
namespace App\Http\Controllers\Manager\TypeInstallment\Requests;

use App\Http\Requests\ValidatedRequest;

class CreateTypeInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"TypeInstallment_Code"		=> "required|string|max:2",
			"TypeInstallment_Name"		=> "required|string|max:250",
			"TypeInstallment_Abrv"		=> "required|string|max:4",
			"TypeInstallment_Public"	=> "required|int|in:1,2",
			"TypeInstallment_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}