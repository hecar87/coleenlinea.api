<?php

namespace App\Modules\TypeReceipt\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class CreateTypeReceiptRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"TypeReceipt_Code"		=> "required|string|max:2",
			"TypeReceipt_Name"		=> "required|string|max:250",
			"TypeReceipt_Abrv"		=> "required|string|max:4",
			"TypeReceipt_Public"	=> "required|int|in:1,2",
			"TypeReceipt_Status"	=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}