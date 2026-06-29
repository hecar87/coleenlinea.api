<?php
namespace App\Modules\Guardian\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;


// Requests
use App\Modules\Guardian\Http\Requests\Manager\CreateGuardianRequest;
use App\Modules\Guardian\Http\Requests\Manager\UpdateGuardianRequest;
use App\Modules\Guardian\Http\Requests\Manager\ListGuardianRequest;
use App\Modules\Guardian\Http\Requests\Manager\SearchGuardianRequest;

// DTOs
use App\Modules\Guardian\Application\DTOs\CreateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\UpdateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\SearchGuardianDTO;

// Actions
use App\Modules\Guardian\Application\Actions\CreateGuardianAction;
use App\Modules\Guardian\Application\Actions\UpdateGuardianAction;
use App\Modules\Guardian\Application\Actions\DeleteGuardianAction;
use App\Modules\Guardian\Application\Actions\IndexGuardianAction;
use App\Modules\Guardian\Application\Actions\ListGuardianAction;
use App\Modules\Guardian\Application\Actions\SearchGuardianAction;


class GuardianController extends Controller
{
	protected IGuardianRepository $repository;

	public function __construct(
		IGuardianRepository $repository,

		private CreateGuardianAction $oCreateGuardianAction,
		private UpdateGuardianAction $oUpdateGuardianAction,
		private DeleteGuardianAction $oDeleteGuardianAction,
		private IndexGuardianAction $oIndexGuardianAction,
		private ListGuardianAction $oListGuardianAction,
		private SearchGuardianAction $oSearchGuardianAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateGuardianAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateGuardianAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_Guardian)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteGuardianAction->execute($Id_Guardian);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_Guardian)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexGuardianAction->execute($Id_Guardian);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListGuardianAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchGuardianAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}