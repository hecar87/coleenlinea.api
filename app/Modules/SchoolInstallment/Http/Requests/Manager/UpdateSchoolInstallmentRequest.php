<?php

namespace App\Modules\SchoolInstallment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolInstallment"				=> "required|int",
			"SchoolInstallment_Amount"			=> "required|numeric",
			"SchoolInstallment_Date_Start"		=> "required|date_format:Y-m-d",
			"SchoolInstallment_Date_End"		=> "required|date_format:Y-m-d",
			"SchoolInstallment_Promoted"		=> "required|int|in:1,2",
			"SchoolInstallment_Repeated"		=> "required|int|in:1,2",
			"SchoolInstallment_Newed"			=> "required|int|in:1,2",
			"SchoolInstallment_Status"			=> "required|int|in:1,2",
			"Id_School"							=> "required|int",
			"Id_SchoolYear"						=> "required|int",
			"Id_SchoolLevel"					=> "required|int",
			"Id_TypeCurrency"					=> "required|int",
			"Id_TypeInstallment"				=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}