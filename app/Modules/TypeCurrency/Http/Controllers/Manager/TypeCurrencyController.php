<?php
namespace App\Modules\TypeCurrency\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;


// Requests
use App\Modules\TypeCurrency\Http\Requests\Manager\CreateTypeCurrencyRequest;
use App\Modules\TypeCurrency\Http\Requests\Manager\UpdateTypeCurrencyRequest;
use App\Modules\TypeCurrency\Http\Requests\Manager\ListTypeCurrencyRequest;
use App\Modules\TypeCurrency\Http\Requests\Manager\SearchTypeCurrencyRequest;

// DTOs
use App\Modules\TypeCurrency\Application\DTOs\CreateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\UpdateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\SearchTypeCurrencyDTO;

// Actions
use App\Modules\TypeCurrency\Application\Actions\CreateTypeCurrencyAction;
use App\Modules\TypeCurrency\Application\Actions\UpdateTypeCurrencyAction;
use App\Modules\TypeCurrency\Application\Actions\DeleteTypeCurrencyAction;
use App\Modules\TypeCurrency\Application\Actions\IndexTypeCurrencyAction;
use App\Modules\TypeCurrency\Application\Actions\ListTypeCurrencyAction;
use App\Modules\TypeCurrency\Application\Actions\SearchTypeCurrencyAction;


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