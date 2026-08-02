<?php
namespace App\Modules\PaymentGateway\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;


// Requests
use App\Modules\PaymentGateway\Http\Requests\Manager\CreatePaymentGatewayRequest;
use App\Modules\PaymentGateway\Http\Requests\Manager\UpdatePaymentGatewayRequest;
use App\Modules\PaymentGateway\Http\Requests\Manager\ListPaymentGatewayRequest;
use App\Modules\PaymentGateway\Http\Requests\Manager\SearchPaymentGatewayRequest;

// DTOs
use App\Modules\PaymentGateway\Application\DTOs\CreatePaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\UpdatePaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\SearchPaymentGatewayDTO;

// Actions
use App\Modules\PaymentGateway\Application\Actions\CreatePaymentGatewayAction;
use App\Modules\PaymentGateway\Application\Actions\UpdatePaymentGatewayAction;
use App\Modules\PaymentGateway\Application\Actions\DeletePaymentGatewayAction;
use App\Modules\PaymentGateway\Application\Actions\IndexPaymentGatewayAction;
use App\Modules\PaymentGateway\Application\Actions\ListPaymentGatewayAction;
use App\Modules\PaymentGateway\Application\Actions\SearchPaymentGatewayAction;


class PaymentGatewayController extends Controller
{
	protected IPaymentGatewayRepository $repository;

	public function __construct(
		IPaymentGatewayRepository $repository,

		private CreatePaymentGatewayAction $oCreatePaymentGatewayAction,
		private UpdatePaymentGatewayAction $oUpdatePaymentGatewayAction,
		private DeletePaymentGatewayAction $oDeletePaymentGatewayAction,
		private IndexPaymentGatewayAction $oIndexPaymentGatewayAction,
		private ListPaymentGatewayAction $oListPaymentGatewayAction,
		private SearchPaymentGatewayAction $oSearchPaymentGatewayAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreatePaymentGatewayRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreatePaymentGatewayDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreatePaymentGatewayAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdatePaymentGatewayRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdatePaymentGatewayDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdatePaymentGatewayAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_PaymentGateway)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeletePaymentGatewayAction->execute($Id_PaymentGateway);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_PaymentGateway)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexPaymentGatewayAction->execute($Id_PaymentGateway);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListPaymentGatewayRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListPaymentGatewayAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchPaymentGatewayRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchPaymentGatewayDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchPaymentGatewayAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}