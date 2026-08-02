<?php

namespace App\Modules\PaymentGateway\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\PaymentGateway\Application\DTOs\CreatePaymentDTO;
use App\Modules\PaymentGateway\Application\DTOs\AuthorizePaymentDTO;
use App\Modules\PaymentGateway\Application\DTOs\VerifyPaymentDTO;


interface IPaymentGatewayRepository
{
    public function getEntity(): string;

    public function create(CreatePaymentDTO $dto) : Result;

    public function authorize(AuthorizePaymentDTO $dto) : Result;

    public function verify(VerifyPaymentDTO $dto) : Result;
}