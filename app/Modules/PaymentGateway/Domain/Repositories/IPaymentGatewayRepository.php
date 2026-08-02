<?php

namespace App\Modules\PaymentGateway\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\PaymentGateway\Entities\PaymentGateway;
use App\Modules\PaymentGateway\Application\DTOs\CreatePaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\UpdatePaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\DuplicatedPaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\SearchPaymentGatewayDTO;
use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayFilterDisplay;


interface IPaymentGatewayRepository
{
    public function getEntity(): string;

    public function exists(int $Id_PaymentGateway) : Result;

    public function duplicated(DuplicatedPaymentGatewayDTO $dto) : Result;

    public function create(CreatePaymentGatewayDTO $dto) : Result;

    public function update(UpdatePaymentGatewayDTO $dto) : Result;

    public function delete(int $Id_PaymentGateway) : Result;

    public function index(int $Id_PaymentGateway) : Result;

    public function list(PaymentGatewayFilterDisplay $Display) : Result;

    public function search(SearchPaymentGatewayDTO $dto) : Result;
}