<?php
namespace App\Http\Controllers\Manager\TypeFee;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeFee\Repositories\ITypeFeeRepository;


// Requests
use App\Http\Controllers\Manager\TypeFee\Requests\CreateTypeFeeRequest;
use App\Http\Controllers\Manager\TypeFee\Requests\UpdateTypeFeeRequest;
use App\Http\Controllers\Manager\TypeFee\Requests\ListTypeFeeRequest;
use App\Http\Controllers\Manager\TypeFee\Requests\SearchTypeFeeRequest;

// DTOs
use App\Application\TypeFee\DTOs\CreateTypeFeeDTO;
use App\Application\TypeFee\DTOs\UpdateTypeFeeDTO;
use App\Application\TypeFee\DTOs\SearchTypeFeeDTO;

// Actions
use App\Application\TypeFee\Actions\CreateTypeFeeAction;
use App\Application\TypeFee\Actions\UpdateTypeFeeAction;
use App\Application\TypeFee\Actions\DeleteTypeFeeAction;
use App\Application\TypeFee\Actions\IndexTypeFeeAction;
use App\Application\TypeFee\Actions\ListTypeFeeAction;
use App\Application\TypeFee\Actions\SearchTypeFeeAction;


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