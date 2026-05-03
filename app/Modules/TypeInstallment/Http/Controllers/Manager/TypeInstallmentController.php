<?php

namespace App\Modules\TypeInstallment\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeInstallment\Domain\Repositories\ITypeInstallmentRepository;


// Requests
use App\Modules\TypeInstallment\Http\Requests\Manager\CreateTypeInstallmentRequest;
use App\Modules\TypeInstallment\Http\Requests\Manager\UpdateTypeInstallmentRequest;
use App\Modules\TypeInstallment\Http\Requests\Manager\ListTypeInstallmentRequest;
use App\Modules\TypeInstallment\Http\Requests\Manager\SearchTypeInstallmentRequest;

// DTOs
use App\Modules\TypeInstallment\Application\DTOs\CreateTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\UpdateTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\SearchTypeInstallmentDTO;

// Actions
use App\Modules\TypeInstallment\Application\Actions\CreateTypeInstallmentAction;
use App\Modules\TypeInstallment\Application\Actions\UpdateTypeInstallmentAction;
use App\Modules\TypeInstallment\Application\Actions\DeleteTypeInstallmentAction;
use App\Modules\TypeInstallment\Application\Actions\IndexTypeInstallmentAction;
use App\Modules\TypeInstallment\Application\Actions\ListTypeInstallmentAction;
use App\Modules\TypeInstallment\Application\Actions\SearchTypeInstallmentAction;


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