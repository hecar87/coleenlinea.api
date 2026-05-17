<?php

namespace App\Modules\TypePayment\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypePayment\Domain\Repositories\ITypePaymentRepository;


// Requests
use App\Modules\TypePayment\Http\Requests\Manager\CreateTypePaymentRequest;
use App\Modules\TypePayment\Http\Requests\Manager\UpdateTypePaymentRequest;
use App\Modules\TypePayment\Http\Requests\Manager\ListTypePaymentRequest;
use App\Modules\TypePayment\Http\Requests\Manager\SearchTypePaymentRequest;

// DTOs
use App\Modules\TypePayment\Application\DTOs\CreateTypePaymentDTO;
use App\Modules\TypePayment\Application\DTOs\UpdateTypePaymentDTO;
use App\Modules\TypePayment\Application\DTOs\SearchTypePaymentDTO;

// Actions
use App\Modules\TypePayment\Application\Actions\CreateTypePaymentAction;
use App\Modules\TypePayment\Application\Actions\UpdateTypePaymentAction;
use App\Modules\TypePayment\Application\Actions\DeleteTypePaymentAction;
use App\Modules\TypePayment\Application\Actions\IndexTypePaymentAction;
use App\Modules\TypePayment\Application\Actions\ListTypePaymentAction;
use App\Modules\TypePayment\Application\Actions\SearchTypePaymentAction;


class TypePaymentController extends Controller
{
	protected ITypePaymentRepository $repository;

	public function __construct(
		ITypePaymentRepository $repository,

		private CreateTypePaymentAction $oCreateTypePaymentAction,
		private UpdateTypePaymentAction $oUpdateTypePaymentAction,
		private DeleteTypePaymentAction $oDeleteTypePaymentAction,
		private IndexTypePaymentAction $oIndexTypePaymentAction,
		private ListTypePaymentAction $oListTypePaymentAction,
		private SearchTypePaymentAction $oSearchTypePaymentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypePaymentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypePaymentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypePaymentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypePaymentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypePaymentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypePaymentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypePayment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypePaymentAction->execute($Id_TypePayment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypePayment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypePaymentAction->execute($Id_TypePayment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypePaymentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypePaymentAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypePaymentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypePaymentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypePaymentAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}