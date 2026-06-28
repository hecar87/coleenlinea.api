<?php

namespace App\Modules\SchoolYear\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateSchoolYearRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"SchoolYear_Name"			=> "required|string|max:250",
			"SchoolYear_Year"			=> "required|int",
			"SchoolYear_Date_Start"		=> "required|date_format:Y-m-d",
			"SchoolYear_Date_End"		=> "required|date_format:Y-m-d",
			"SchoolYear_Status"			=> "required|int|in:1,2",
			"Id_School"					=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}