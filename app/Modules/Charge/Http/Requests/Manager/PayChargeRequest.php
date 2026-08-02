<?php

namespace App\Modules\Charge\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class PayChargeRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Charge"					=> "required|int",
			"Charge_Pay_Signature"		=> "required|string|max:250",
			"Charge_Pay_Authorization"	=> "required|string|max:250",
			"Charge_Pay_Message"		=> "required|string|max:250",
			"Charge_Pay_Description"	=> "required|string|max:250",
			"Charge_Pay_ECIDescription"	=> "required|string|max:250",
			"Charge_Card_Last"			=> "required|string|max:20",
			"Charge_Card_Number"		=> "required|string|max:20",
			"Charge_Card_Brand"			=> "required|string|max:100",
			"Charge_Card_Type"			=> "required|string|max:100",
			"Charge_Card_Issuer"		=> "required|string|max:100",
			"Charge_Response"			=> "required|string|max:250"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}