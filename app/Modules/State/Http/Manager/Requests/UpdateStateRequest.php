<?php
namespace App\Http\Controllers\Manager\State\Requests;

use App\Http\Requests\ValidatedRequest;

class UpdateStateRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_State"			=> "required|int",
			"State_Code"		=> "required|string|max:2",
			"State_Name"		=> "required|string|max:250",
			"State_Abrv"		=> "required|string|max:4",
			"State_Public"		=> "required|int|in:1,2",
			"State_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}