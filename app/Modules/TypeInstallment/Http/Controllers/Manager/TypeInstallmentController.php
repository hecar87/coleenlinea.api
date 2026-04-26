<?php
namespace App\Http\Controllers\Manager\TypeInstallment;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeInstallment\Repositories\ITypeInstallmentRepository;


// Requests
use App\Http\Controllers\Manager\TypeInstallment\Requests\CreateTypeInstallmentRequest;
use App\Http\Controllers\Manager\TypeInstallment\Requests\UpdateTypeInstallmentRequest;
use App\Http\Controllers\Manager\TypeInstallment\Requests\ListTypeInstallmentRequest;
use App\Http\Controllers\Manager\TypeInstallment\Requests\SearchTypeInstallmentRequest;

// DTOs
use App\Application\TypeInstallment\DTOs\CreateTypeInstallmentDTO;
use App\Application\TypeInstallment\DTOs\UpdateTypeInstallmentDTO;
use App\Application\TypeInstallment\DTOs\SearchTypeInstallmentDTO;

// Actions
use App\Application\TypeInstallment\Actions\CreateTypeInstallmentAction;
use App\Application\TypeInstallment\Actions\UpdateTypeInstallmentAction;
use App\Application\TypeInstallment\Actions\DeleteTypeInstallmentAction;
use App\Application\TypeInstallment\Actions\IndexTypeInstallmentAction;
use App\Application\TypeInstallment\Actions\ListTypeInstallmentAction;
use App\Application\TypeInstallment\Actions\SearchTypeInstallmentAction;


class TypeInstallmentController extends Controller
{
	protected ITypeInstallmentRepository $repository;

	public function __construct(
		ITypeInstallmentRepository $repository,

		private CreateTypeInstallmentAction $oCreateTypeInstallmentAction,
		private UpdateTypeInstallmentAction $oUpdateTypeInstallmentAction,
		private DeleteTypeInstallmentAction $oDeleteTypeInstallmentAction,
		private IndexTypeInstallmentAction $oIndexTypeInstallmentAction,
		private ListTypeInstallmentAction $oListTypeInstallmentAction,
		private SearchTypeInstallmentAction $oSearchTypeInstallmentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeInstallmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeInstallmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeInstallment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeInstallmentAction->execute($Id_TypeInstallment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeInstallment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeInstallmentAction->execute($Id_TypeInstallment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeInstallmentAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeInstallmentAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}