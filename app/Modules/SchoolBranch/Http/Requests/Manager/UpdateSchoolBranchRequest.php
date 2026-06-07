<?php

namespace App\Modules\SchoolBranch\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateSchoolBranchRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_SchoolBranch"		=> "required|int",
			"SchoolBranch_Code"		=> "required|string|max:30",
			"SchoolBranch_Name"		=> "required|string|max:250",
			"SchoolBranch_Address"	=> "required|string|max:250",
			"SchoolBranch_Phone"	=> "required|string|max:30",
			"SchoolBranch_LAT"		=> "required|numeric",
			"SchoolBranch_LNG"		=> "required|numeric",
			"SchoolBranch_Public"	=> "required|int|in:1,2",
			"SchoolBranch_Status"	=> "required|int|in:1,2",
			"Id_School"				=> "required|int",
			"Id_State"				=> "required|int",
			"Id_City"				=> "required|int",
			"Id_District"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}