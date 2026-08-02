<?php

namespace App\Modules\PaymentGateway\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;

use App\Modules\PaymentGateway\Application\DTOs\CreatePaymentDTO;
use App\Modules\PaymentGateway\Application\DTOs\AuthorizePaymentDTO;
use App\Modules\PaymentGateway\Application\DTOs\VerifyPaymentDTO;


class NiubizPaymentGatewayRepository implements IPaymentGatewayRepository
{
	protected string $oEntity;

	public function __construct()
    {
        $this->oEntity = "PAYMENT-GATEWAY-NIUBIZ";
    }

	public function getEntity(): string
	{
		return $this->oEntity;
	}

	protected function getBaseUrl(): string
    {
        return config(
            'paymentgateway.niubiz.environment'
        ) === 'production'
            ? 'https://apiprod.vnforapps.com'
            : 'https://apisandbox.vnforappstest.com';
    }

	protected function getAccessToken(): Result
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
            $pUsername 	= config('paymentgateway.niubiz.username');
            $pPassword 	= config('paymentgateway.niubiz.password');
			$pURL 		= $this->getBaseUrl() . '/api.security/v1/security';

            $oResponse = Http::timeout(30)->withBasicAuth($pUsername,$pPassword)->get($pURL);
            if ($oResponse->status() <> 201) { return ResultManager::Result(2000, $oEntity, null, 0, $oResponse->body() );}

			$oData = [
				'Payment_AccessToken' => trim($oResponse->body())
			];
            $oResult = ResultManager::Result(1002, $oEntity, $oData );
        } catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
    }

    protected function createSession(string $pAccessToken, CreatePaymentDTO $dto): Result
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
            $pMerchantId 	= config("paymentgateway.niubiz.merchant_id");
			$pURL 			= $this->getBaseUrl() . '/api.ecommerce/v2/ecommerce/token/session/'. $pMerchantId;


            $oData = [
                'channel' => 'web',
                'amount' => number_format($dto->Payment_Amount, 2, '.', ''),
                'antifraud' => [
                    'clientIp' => $dto->Payment_ClientIp,
                    'merchantDefineData' => [
                        // Los MDD reales serán definidos
                        // según los requerimientos del comercio.
                    ],
                ],
                'dataMap' => [
                    'cardholderPhoneNumber' => $dto->Payment_Phone,
                ],
            ];


            $oResponse = Http::timeout(30)->withToken($pAccessToken)->acceptJson()->post($pURL, $oData);
            if ($oResponse->status() <> 200) { return ResultManager::Result(2000, $oEntity, null, 0, $oResponse->body()); }


            $oResponseData 	= $oResponse->json();
            $oResult		= ResultManager::Result(1002, $oEntity, $oResponseData);
        } catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
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
			$oResult = $this->getAccessToken();
            if ($oResult->RESULT_STS <> 200) { return $oResult; }

			$pAccessToken = $oResult->RESULT_DTA['Payment_AccessToken'];


            //
            // Session Token
            //
            $oResult = $this->createSession($pAccessToken, $dto);

            if ($oResult->RESULT_STS <> 200) { return $oResult; }


            //
            // Response
            //
            $oData = [
                'Id_Charge' 				=> $dto->Id_Charge,
                'Charge_Code' 				=> $dto->Charge_Code,
                'Payment_SessionKey' 		=> $oResult->RESULT_DTA['sessionKey'],
                'Payment_ExpirationTime'	=> $oResult->RESULT_DTA['expirationTime'],
            ];

            $oResult = ResultManager::Result(1002, $oEntity, $oData );
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
