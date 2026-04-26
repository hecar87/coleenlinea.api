<?php
namespace App\Http\Controllers\Manager\TypePayment;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypePayment\Repositories\ITypePaymentRepository;


// Requests
use App\Http\Controllers\Manager\TypePayment\Requests\CreateTypePaymentRequest;
use App\Http\Controllers\Manager\TypePayment\Requests\UpdateTypePaymentRequest;
use App\Http\Controllers\Manager\TypePayment\Requests\ListTypePaymentRequest;
use App\Http\Controllers\Manager\TypePayment\Requests\SearchTypePaymentRequest;

// DTOs
use App\Application\TypePayment\DTOs\CreateTypePaymentDTO;
use App\Application\TypePayment\DTOs\UpdateTypePaymentDTO;
use App\Application\TypePayment\DTOs\SearchTypePaymentDTO;

// Actions
use App\Application\TypePayment\Actions\CreateTypePaymentAction;
use App\Application\TypePayment\Actions\UpdateTypePaymentAction;
use App\Application\TypePayment\Actions\DeleteTypePaymentAction;
use App\Application\TypePayment\Actions\IndexTypePaymentAction;
use App\Application\TypePayment\Actions\ListTypePaymentAction;
use App\Application\TypePayment\Actions\SearchTypePaymentAction;


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