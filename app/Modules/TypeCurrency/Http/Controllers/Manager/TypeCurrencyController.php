<?php
namespace App\Modules\TypeCurrency\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeCurrency\Repositories\ITypeCurrencyRepository;


// Requests
use App\Http\Controllers\Manager\TypeCurrency\Requests\CreateTypeCurrencyRequest;
use App\Http\Controllers\Manager\TypeCurrency\Requests\UpdateTypeCurrencyRequest;
use App\Http\Controllers\Manager\TypeCurrency\Requests\ListTypeCurrencyRequest;
use App\Http\Controllers\Manager\TypeCurrency\Requests\SearchTypeCurrencyRequest;

// DTOs
use App\Application\TypeCurrency\DTOs\CreateTypeCurrencyDTO;
use App\Application\TypeCurrency\DTOs\UpdateTypeCurrencyDTO;
use App\Application\TypeCurrency\DTOs\SearchTypeCurrencyDTO;

// Actions
use App\Application\TypeCurrency\Actions\CreateTypeCurrencyAction;
use App\Application\TypeCurrency\Actions\UpdateTypeCurrencyAction;
use App\Application\TypeCurrency\Actions\DeleteTypeCurrencyAction;
use App\Application\TypeCurrency\Actions\IndexTypeCurrencyAction;
use App\Application\TypeCurrency\Actions\ListTypeCurrencyAction;
use App\Application\TypeCurrency\Actions\SearchTypeCurrencyAction;


class TypeCurrencyController extends Controller
{
	protected ITypeCurrencyRepository $repository;

	public function __construct(
		ITypeCurrencyRepository $repository,

		private CreateTypeCurrencyAction $oCreateTypeCurrencyAction,
		private UpdateTypeCurrencyAction $oUpdateTypeCurrencyAction,
		private DeleteTypeCurrencyAction $oDeleteTypeCurrencyAction,
		private IndexTypeCurrencyAction $oIndexTypeCurrencyAction,
		private ListTypeCurrencyAction $oListTypeCurrencyAction,
		private SearchTypeCurrencyAction $oSearchTypeCurrencyAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeCurrencyRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeCurrencyDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeCurrencyAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeCurrencyRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeCurrencyDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeCurrencyAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeCurrency)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeCurrencyAction->execute($Id_TypeCurrency);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeCurrency)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeCurrencyAction->execute($Id_TypeCurrency);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeCurrencyRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeCurrencyAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeCurrencyRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeCurrencyDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeCurrencyAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}