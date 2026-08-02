<?php

namespace App\Modules\PaymentGateway\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;

use App\Modules\PaymentGateway\Application\DTOs\CreatePaymentDTO;
use App\Modules\PaymentGateway\Application\DTOs\AuthorizePaymentDTO;
use App\Modules\PaymentGateway\Application\DTOs\VerifyPaymentDTO;


class CulqiPaymentGatewayRepository implements IPaymentGatewayRepository
{
	protected string $oEntity;

	public function __construct()
    {
        $this->oEntity = "PAYMENT-GATEWAY-CULQI";
    }

	public function getEntity(): string
	{
		return $this->oEntity;
	}

    public function create(CreatePaymentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= $this->oEntity;
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
        try
        {

		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
    }


    public function authorize(AuthorizePaymentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= $this->oEntity;
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
        try
        {

		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
    }


    public function verify(VerifyPaymentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= $this->oEntity;
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
        try
        {

		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
    }
}