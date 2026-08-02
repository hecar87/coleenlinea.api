<?php

namespace App\Modules\Charge\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateChargeRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Charge"				=> "required|int",
			"Charge_Name"			=> "required|string|max:100",
			"Charge_LastName"		=> "required|string|max:100",
			"Charge_Email"			=> "required|string|email|max:250",
			"Charge_NoDocument"		=> "required|string|max:20",
			"Charge_Phone"			=> "required|string|max:20",
			"Id_Guardian"			=> "required|int",
			"Id_TypeCurrency"		=> "required|int",
			"Id_TypePayment"		=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}