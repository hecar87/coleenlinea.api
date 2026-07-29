<?php

namespace App\Modules\Charge\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateChargeRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Charge"				=> "required|int",
			"Charge_BusinessName"	=> "required|string|max:200",
			"Charge_TradeName"		=> "required|string|max:200",
			"Charge_NoDocument"		=> "required|string|max:30",
			"Charge_Address"		=> "required|string|max:250",
			"Charge_Phone"			=> "required|string|max:30",
			"Charge_Public"			=> "required|int|in:1,2",
			"Charge_Status"			=> "required|int|in:1,2",
			"Id_State"				=> "required|int",
			"Id_City"				=> "required|int",
			"Id_District"			=> "required|int",
			"Id_TypeDocument"		=> "required|int",
			"Id_TypePopulation"		=> "required|int",
			"Id_TypeCharge"			=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}