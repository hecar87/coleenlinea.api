<?php
namespace App\Http\Controllers\Manager\TypePayment\Requests;

use App\Http\Requests\ValidatedRequest;

class UpdateTypePaymentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypePayment"		=> "required|int",
			"TypePayment_Code"		=> "required|string|max:2",
			"TypePayment_Name"		=> "required|string|max:250",
			"TypePayment_Abrv"		=> "required|string|max:4",
			"TypePayment_Public"	=> "required|int|in:1,2",
			"TypePayment_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}