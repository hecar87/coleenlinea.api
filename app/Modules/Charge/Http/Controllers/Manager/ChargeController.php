<?php
namespace App\Modules\Charge\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\Charge\Domain\Repositories\IChargeRepository;


// Requests
use App\Modules\Charge\Http\Requests\Manager\CreateChargeRequest;
use App\Modules\Charge\Http\Requests\Manager\UpdateChargeRequest;
use App\Modules\Charge\Http\Requests\Manager\ListChargeRequest;
use App\Modules\Charge\Http\Requests\Manager\SearchChargeRequest;

// DTOs
use App\Modules\Charge\Application\DTOs\CreateChargeDTO;
use App\Modules\Charge\Application\DTOs\UpdateChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeDTO;

// Actions
use App\Modules\Charge\Application\Actions\CreateChargeAction;
use App\Modules\Charge\Application\Actions\UpdateChargeAction;
use App\Modules\Charge\Application\Actions\DeleteChargeAction;
use App\Modules\Charge\Application\Actions\IndexChargeAction;
use App\Modules\Charge\Application\Actions\ListChargeAction;
use App\Modules\Charge\Application\Actions\SearchChargeAction;


class ChargeController extends Controller
{
	protected IChargeRepository $repository;

	public function __construct(
		IChargeRepository $repository,

		private CreateChargeAction $oCreateChargeAction,
		private UpdateChargeAction $oUpdateChargeAction,
		private DeleteChargeAction $oDeleteChargeAction,
		private IndexChargeAction $oIndexChargeAction,
		private ListChargeAction $oListChargeAction,
		private SearchChargeAction $oSearchChargeAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateChargeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateChargeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateChargeAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateChargeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateChargeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateChargeAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_Charge)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteChargeAction->execute($Id_Charge);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_Charge)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexChargeAction->execute($Id_Charge);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListChargeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListChargeAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchChargeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchChargeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchChargeAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}