<?php
namespace App\Modules\Contract\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\Contract\Domain\Repositories\IContractRepository;


// Requests
use App\Modules\Contract\Http\Requests\Manager\CreateContractRequest;
use App\Modules\Contract\Http\Requests\Manager\UpdateContractRequest;
use App\Modules\Contract\Http\Requests\Manager\ListContractRequest;
use App\Modules\Contract\Http\Requests\Manager\SearchContractRequest;

// DTOs
use App\Modules\Contract\Application\DTOs\CreateContractDTO;
use App\Modules\Contract\Application\DTOs\UpdateContractDTO;
use App\Modules\Contract\Application\DTOs\SearchContractDTO;

// Actions
use App\Modules\Contract\Application\Actions\CreateContractAction;
use App\Modules\Contract\Application\Actions\UpdateContractAction;
use App\Modules\Contract\Application\Actions\DeleteContractAction;
use App\Modules\Contract\Application\Actions\IndexContractAction;
use App\Modules\Contract\Application\Actions\ListContractAction;
use App\Modules\Contract\Application\Actions\SearchContractAction;
use App\Modules\Contract\Application\Actions\ApproveContractAction;
use App\Modules\Contract\Application\Actions\NullifyContractAction;
use App\Modules\Contract\Application\Actions\CloseContractAction;


class ContractController extends Controller
{
	protected IContractRepository $repository;

	public function __construct(
		IContractRepository $repository,

		private CreateContractAction $oCreateContractAction,
		private UpdateContractAction $oUpdateContractAction,
		private DeleteContractAction $oDeleteContractAction,
		private IndexContractAction $oIndexContractAction,
		private ListContractAction $oListContractAction,
		private SearchContractAction $oSearchContractAction,
		private ApproveContractAction $oApproveContractAction,
		private NullifyContractAction $oNullifyContractAction,
		private CloseContractAction $oCloseContractAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateContractRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateContractDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateContractAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateContractRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateContractDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateContractAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_Contract)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteContractAction->execute($Id_Contract);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_Contract)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexContractAction->execute($Id_Contract);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListContractRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListContractAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchContractRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchContractDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchContractAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

	public function approve(int $Id_Contract)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oApproveContractAction->execute($Id_Contract);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function nullify(int $Id_Contract)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oNullifyContractAction->execute($Id_Contract);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function close(int $Id_Contract)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCloseContractAction->execute($Id_Contract);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

}