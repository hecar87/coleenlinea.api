<?php

namespace App\Modules\PaymentGateway\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdatePaymentGatewayRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_PaymentGateway"			=> "required|int",
			"PaymentGateway_Code"		=> "required|string|max:2",
			"PaymentGateway_Name"		=> "required|string|max:250",
			"PaymentGateway_Abrv"		=> "required|string|max:4",
			"PaymentGateway_Public"		=> "required|int|in:1,2",
			"PaymentGateway_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}