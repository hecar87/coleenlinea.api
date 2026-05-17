<?php

namespace App\Modules\TypePopulation\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateTypePopulationRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"TypePopulation_Code"		=> "required|string|max:2",
			"TypePopulation_Name"		=> "required|string|max:250",
			"TypePopulation_Abrv"		=> "required|string|max:4",
			"TypePopulation_Public"		=> "required|int|in:1,2",
			"TypePopulation_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}