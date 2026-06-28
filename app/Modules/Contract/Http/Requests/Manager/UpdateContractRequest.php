<?php

namespace App\Modules\Contract\Http\Requests\Manager;

use App\Http\Requests\ValidatedRequest;

class UpdateContractRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_Contract"					=> "required|int",
			"Contract_Title"				=> "required|string|max:250",
			"Contract_Date_Start"			=> "required|date_format:Y-m-d",
			"Contract_Date_End"				=> "required|date_format:Y-m-d",
			"Contract_Manager_Name"			=> "required|string|max:200",
			"Contract_Manager_LastName"		=> "required|string|max:200",
			"Contract_Manager_Position"		=> "required|string|max:200",
			"Contract_Manager_Document"		=> "required|string|max:20",
			"Id_TypeDocument"				=> "required|int"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}