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
use App\Modules\Charge\Http\Requests\Manager\ListChargeByguardianRequest;
use App\Modules\Charge\Http\Requests\Manager\SearchChargeRequest;
use App\Modules\Charge\Http\Requests\Manager\SearchChargeByguardianRequest;
use App\Modules\Charge\Http\Requests\Manager\PayChargeRequest;

// DTOs
use App\Modules\Charge\Application\DTOs\CreateChargeDTO;
use App\Modules\Charge\Application\DTOs\UpdateChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeByGuardianDTO;
use App\Modules\Charge\Application\DTOs\PayChargeDTO;

// Actions
use App\Modules\Charge\Application\Actions\CreateChargeAction;
use App\Modules\Charge\Application\Actions\UpdateChargeAction;
use App\Modules\Charge\Application\Actions\DeleteChargeAction;
use App\Modules\Charge\Application\Actions\IndexChargeAction;
use App\Modules\Charge\Application\Actions\ListChargeByGuardianAction;
use App\Modules\Charge\Application\Actions\SearchChargeAction;
use App\Modules\Charge\Application\Actions\SearchChargeByGuardianAction;
use App\Modules\Charge\Application\Actions\PayChargeAction;
use App\Modules\Charge\Application\Actions\NullifyChargeAction;


class ChargeController extends Controller
{
	protected IChargeRepository $repository;

	public function __construct(
		IChargeRepository $repository,

		private CreateChargeAction $oCreateChargeAction,
		private UpdateChargeAction $oUpdateChargeAction,
		private DeleteChargeAction $oDeleteChargeAction,
		private IndexChargeAction $oIndexChargeAction,
		private ListChargeByGuardianAction $oListChargeByGuardianAction,
		private SearchChargeAction $oSearchChargeAction,
		private SearchChargeByGuardianAction $oSearchChargeByGuardianAction,
		private PayChargeAction $oPayChargeAction,
		private NullifyChargeAction $oNullifyChargeAction
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

	public function listByGuardian(int $Id_Guardian)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListChargeByGuardianAction->execute($Id_Guardian);
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

	public function searchByGuardian(int $Id_Guardian, SearchChargeByGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchChargeByGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchChargeByGuardianAction->execute($Id_Guardian, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

	public function pay(PayChargeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = PayChargeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oPayChargeAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function nullify(int $Id_Charge)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oNullifyChargeAction->execute($Id_Charge);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

}