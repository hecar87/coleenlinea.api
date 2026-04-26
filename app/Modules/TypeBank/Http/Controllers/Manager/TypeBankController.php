<?php
namespace App\Modules\TypeBank\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeBank\Domain\Repositories\ITypeBankRepository;


// Requests
use App\Modules\TypeBank\Http\Requests\Manager\CreateTypeBankRequest;
use App\Modules\TypeBank\Http\Requests\Manager\UpdateTypeBankRequest;
use App\Modules\TypeBank\Http\Requests\Manager\ListTypeBankRequest;
use App\Modules\TypeBank\Http\Requests\Manager\SearchTypeBankRequest;

// DTOs
use App\Modules\TypeBank\Application\DTOs\CreateTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\UpdateTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\SearchTypeBankDTO;

// Actions
use App\Modules\TypeBank\Application\Actions\CreateTypeBankAction;
use App\Modules\TypeBank\Application\Actions\UpdateTypeBankAction;
use App\Modules\TypeBank\Application\Actions\DeleteTypeBankAction;
use App\Modules\TypeBank\Application\Actions\IndexTypeBankAction;
use App\Modules\TypeBank\Application\Actions\ListTypeBankAction;
use App\Modules\TypeBank\Application\Actions\SearchTypeBankAction;


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