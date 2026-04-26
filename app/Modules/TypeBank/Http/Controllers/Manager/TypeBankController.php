<?php
namespace App\Http\Controllers\Manager\TypeBank;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeBank\Repositories\ITypeBankRepository;


// Requests
use App\Http\Controllers\Manager\TypeBank\Requests\CreateTypeBankRequest;
use App\Http\Controllers\Manager\TypeBank\Requests\UpdateTypeBankRequest;
use App\Http\Controllers\Manager\TypeBank\Requests\ListTypeBankRequest;
use App\Http\Controllers\Manager\TypeBank\Requests\SearchTypeBankRequest;

// DTOs
use App\Application\TypeBank\DTOs\CreateTypeBankDTO;
use App\Application\TypeBank\DTOs\UpdateTypeBankDTO;
use App\Application\TypeBank\DTOs\SearchTypeBankDTO;

// Actions
use App\Application\TypeBank\Actions\CreateTypeBankAction;
use App\Application\TypeBank\Actions\UpdateTypeBankAction;
use App\Application\TypeBank\Actions\DeleteTypeBankAction;
use App\Application\TypeBank\Actions\IndexTypeBankAction;
use App\Application\TypeBank\Actions\ListTypeBankAction;
use App\Application\TypeBank\Actions\SearchTypeBankAction;


class TypeBankController extends Controller
{
	protected ITypeBankRepository $repository;

	public function __construct(
		ITypeBankRepository $repository,

		private CreateTypeBankAction $oCreateTypeBankAction,
		private UpdateTypeBankAction $oUpdateTypeBankAction,
		private DeleteTypeBankAction $oDeleteTypeBankAction,
		private IndexTypeBankAction $oIndexTypeBankAction,
		private ListTypeBankAction $oListTypeBankAction,
		private SearchTypeBankAction $oSearchTypeBankAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeBankRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeBankDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeBankAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeBankRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeBankDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeBankAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeBank)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeBankAction->execute($Id_TypeBank);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeBank)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeBankAction->execute($Id_TypeBank);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeBankRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeBankAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeBankRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeBankDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeBankAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}