<?php

namespace App\Modules\TypeKinship\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateTypeKinshipRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
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