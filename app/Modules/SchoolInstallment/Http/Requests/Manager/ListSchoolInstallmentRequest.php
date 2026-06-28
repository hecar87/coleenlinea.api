<?php

namespace App\Modules\SchoolInstallment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListSchoolInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [

		];
	}

	public function authorize(): bool
	{
		return true;
	}
}