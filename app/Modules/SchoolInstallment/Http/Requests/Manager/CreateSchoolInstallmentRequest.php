<?php

namespace App\Modules\SchoolInstallment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateSchoolInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"SchoolInstallment_Amount"			=> "required|numeric",
			"SchoolInstallment_Date_Start"		=> "required|date_format:Y-m-d",
			"SchoolInstallment_Date_End"		=> "required|date_format:Y-m-d",
			"SchoolInstallment_Required"		=> "required|int|in:1,2",
			"SchoolInstallment_Status"			=> "required|int|in:1,2",
			"Id_SchoolProfile"					=> "required|int",
			"Id_TypeCurrency"					=> "required|int",
			"Id_TypeInstallment"				=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}