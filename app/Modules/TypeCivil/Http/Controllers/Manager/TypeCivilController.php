<?php
namespace App\Http\Controllers\Manager\TypeCivil;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeCivil\Repositories\ITypeCivilRepository;


// Requests
use App\Http\Controllers\Manager\TypeCivil\Requests\CreateTypeCivilRequest;
use App\Http\Controllers\Manager\TypeCivil\Requests\UpdateTypeCivilRequest;
use App\Http\Controllers\Manager\TypeCivil\Requests\ListTypeCivilRequest;
use App\Http\Controllers\Manager\TypeCivil\Requests\SearchTypeCivilRequest;

// DTOs
use App\Application\TypeCivil\DTOs\CreateTypeCivilDTO;
use App\Application\TypeCivil\DTOs\UpdateTypeCivilDTO;
use App\Application\TypeCivil\DTOs\SearchTypeCivilDTO;

// Actions
use App\Application\TypeCivil\Actions\CreateTypeCivilAction;
use App\Application\TypeCivil\Actions\UpdateTypeCivilAction;
use App\Application\TypeCivil\Actions\DeleteTypeCivilAction;
use App\Application\TypeCivil\Actions\IndexTypeCivilAction;
use App\Application\TypeCivil\Actions\ListTypeCivilAction;
use App\Application\TypeCivil\Actions\SearchTypeCivilAction;


class TypeCivilController extends Controller
{
	protected ITypeCivilRepository $repository;

	public function __construct(
		ITypeCivilRepository $repository,

		private CreateTypeCivilAction $oCreateTypeCivilAction,
		private UpdateTypeCivilAction $oUpdateTypeCivilAction,
		private DeleteTypeCivilAction $oDeleteTypeCivilAction,
		private IndexTypeCivilAction $oIndexTypeCivilAction,
		private ListTypeCivilAction $oListTypeCivilAction,
		private SearchTypeCivilAction $oSearchTypeCivilAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeCivilDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeCivilAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeCivilDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeCivilAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeCivil)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeCivilAction->execute($Id_TypeCivil);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeCivil)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeCivilAction->execute($Id_TypeCivil);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeCivilAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeCivilRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeCivilDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeCivilAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}