<?php
namespace App\Http\Controllers\Manager\TypeKinship\Requests;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeKinshipRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeKinship"			=> "required|int",
			"TypeKinship_Code"		=> "required|string|max:2",
			"TypeKinship_Name"		=> "required|string|max:250",
			"TypeKinship_Abrv"		=> "required|string|max:4",
			"TypeKinship_Public"	=> "required|int|in:1,2",
			"TypeKinship_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}