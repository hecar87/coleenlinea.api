<?php
namespace App\Http\Controllers\Manager\TypeInstallment\Requests;

use App\Http\Requests\ValidatedRequest;

class ListTypeInstallmentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Display"	=> "required|string|max:50|in:ALL,PUBLIC,PRIVATE"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}