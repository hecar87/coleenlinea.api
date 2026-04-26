<?php
namespace App\Http\Controllers\Manager\TypeDocument\Requests;

use App\Http\Requests\ValidatedRequest;

class UpdateTypeDocumentRequest extends ValidatedRequest
{
	public function rules(): array
	{
		return [
			"Id_TypeDocument"			=> "required|int",
			"TypeDocument_Code"		=> "required|string|max:2",
			"TypeDocument_Name"		=> "required|string|max:250",
			"TypeDocument_Abrv"		=> "required|string|max:4",
			"TypeDocument_Public"		=> "required|int|in:1,2",
			"TypeDocument_Status"		=> "required|int|in:1,2"
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}