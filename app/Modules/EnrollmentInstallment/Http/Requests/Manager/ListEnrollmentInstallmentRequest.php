<?php

namespace App\Modules\EnrollmentInstallment\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class ListEnrollmentInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Paid"	=> "required|string|max:50|in:ALL,PAID,PENDING"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}