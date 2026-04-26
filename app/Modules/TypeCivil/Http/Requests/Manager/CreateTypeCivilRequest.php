<?php
namespace App\Http\Controllers\Manager\TypeCivil\Requests;

use App\Http\Requests\ValidatedRequest;

class CreateTypeCivilRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"TypeCivil_Code"		=> "required|string|max:2",
			"TypeCivil_Name"		=> "required|string|max:250",
			"TypeCivil_Abrv"		=> "required|string|max:4",
			"TypeCivil_Public"		=> "required|int|in:1,2",
			"TypeCivil_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}