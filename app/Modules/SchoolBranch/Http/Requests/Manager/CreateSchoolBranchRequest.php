<?php

namespace App\Modules\SchoolBranch\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateSchoolBranchRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"SchoolBranch_Number"		=> "required|string|max:50",
			"SchoolBranch_CCI"			=> "required|string|max:50",
			"SchoolBranch_Remark"		=> "required|string|max:250",
			"SchoolBranch_Public"		=> "required|int|in:1,2",
			"SchoolBranch_Status"		=> "required|int|in:1,2",
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