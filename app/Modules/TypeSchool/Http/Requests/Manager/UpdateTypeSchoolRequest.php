<?php
namespace App\Http\Controllers\Manager\TypeSchool\Requests;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeSchoolRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeSchool"			=> "required|int",
			"TypeSchool_Code"		=> "required|string|max:2",
			"TypeSchool_Name"		=> "required|string|max:250",
			"TypeSchool_Abrv"		=> "required|string|max:4",
			"TypeSchool_Public"		=> "required|int|in:1,2",
			"TypeSchool_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}