<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Helpers\ResultManager;
use App\Helpers\ResponseManager;

abstract class ValidatedRequest extends FormRequest
{
    protected string $entity = 'GLOBAL';

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $oValidator)
    {
        $oResult = ResultManager::Result(2101, $this->entity, null, 0, $oValidator->errors());

        throw new HttpResponseException(
            ResponseManager::Response($oResult)
        );
    }

    // protected function failedAuthorization()
    // {
    //     $oResult = ResultManager::Result(
    //         2300,
    //         $this->entity,
    //         null,
    //         0,
    //         "Unauthorized"
    //     );

    //     throw new HttpResponseException(
    //         ResponseManager::Response($oResult)
    //     );
    // }
}