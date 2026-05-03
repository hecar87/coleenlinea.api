<?php

namespace App\Modules\TypeFee\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeFee\Domain\Repositories\ITypeFeeRepository;


// Requests
use App\Modules\TypeFee\Http\Requests\Manager\CreateTypeFeeRequest;
use App\Modules\TypeFee\Http\Requests\Manager\UpdateTypeFeeRequest;
use App\Modules\TypeFee\Http\Requests\Manager\ListTypeFeeRequest;
use App\Modules\TypeFee\Http\Requests\Manager\SearchTypeFeeRequest;

// DTOs
use App\Modules\TypeFee\Application\DTOs\CreateTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\UpdateTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\SearchTypeFeeDTO;

// Actions
use App\Modules\TypeFee\Application\Actions\CreateTypeFeeAction;
use App\Modules\TypeFee\Application\Actions\UpdateTypeFeeAction;
use App\Modules\TypeFee\Application\Actions\DeleteTypeFeeAction;
use App\Modules\TypeFee\Application\Actions\IndexTypeFeeAction;
use App\Modules\TypeFee\Application\Actions\ListTypeFeeAction;
use App\Modules\TypeFee\Application\Actions\SearchTypeFeeAction;


class TypeFeeController extends Controller
{
	protected ITypeFeeRepository $repository;

	public function __construct(
		ITypeFeeRepository $repository,

		private CreateTypeFeeAction $oCreateTypeFeeAction,
		private UpdateTypeFeeAction $oUpdateTypeFeeAction,
		private DeleteTypeFeeAction $oDeleteTypeFeeAction,
		private IndexTypeFeeAction $oIndexTypeFeeAction,
		private ListTypeFeeAction $oListTypeFeeAction,
		private SearchTypeFeeAction $oSearchTypeFeeAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeFeeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeFeeAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeFeeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeFeeAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeFee)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeFeeAction->execute($Id_TypeFee);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeFee)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeFeeAction->execute($Id_TypeFee);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeFeeAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeFeeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeFeeAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}