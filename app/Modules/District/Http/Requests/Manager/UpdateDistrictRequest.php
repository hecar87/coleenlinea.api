<?php
namespace App\Http\Controllers\Manager\District\Requests;

use App\Http\Requests\ValidatedRequest;

class UpdateDistrictRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_District"			=> "required|int",
			"District_Code"			=> "required|string|max:2",
			"District_Name"			=> "required|string|max:250",
			"District_Public"		=> "required|int|in:1,2",
			"District_Status"		=> "required|int|in:1,2",
			"Id_City"				=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}