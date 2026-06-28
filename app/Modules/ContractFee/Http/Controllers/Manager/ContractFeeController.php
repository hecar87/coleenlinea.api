<?php
namespace App\Modules\ContractFee\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\ContractFee\Domain\Repositories\IContractFeeRepository;


// Requests
use App\Modules\ContractFee\Http\Requests\Manager\CreateContractFeeRequest;
use App\Modules\ContractFee\Http\Requests\Manager\UpdateContractFeeRequest;
use App\Modules\ContractFee\Http\Requests\Manager\ListContractFeeRequest;
use App\Modules\ContractFee\Http\Requests\Manager\SearchContractFeeRequest;

// DTOs
use App\Modules\ContractFee\Application\DTOs\CreateContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\UpdateContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\SearchContractFeeDTO;

// Actions
use App\Modules\ContractFee\Application\Actions\CreateContractFeeAction;
use App\Modules\ContractFee\Application\Actions\UpdateContractFeeAction;
use App\Modules\ContractFee\Application\Actions\DeleteContractFeeAction;
use App\Modules\ContractFee\Application\Actions\IndexContractFeeAction;
use App\Modules\ContractFee\Application\Actions\ListContractFeeAction;
use App\Modules\ContractFee\Application\Actions\SearchContractFeeAction;


class ContractFeeController extends Controller
{
	protected IContractFeeRepository $repository;

	public function __construct(
		IContractFeeRepository $repository,

		private CreateContractFeeAction $oCreateContractFeeAction,
		private UpdateContractFeeAction $oUpdateContractFeeAction,
		private DeleteContractFeeAction $oDeleteContractFeeAction,
		private IndexContractFeeAction $oIndexContractFeeAction,
		private ListContractFeeAction $oListContractFeeAction,
		private SearchContractFeeAction $oSearchContractFeeAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateContractFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateContractFeeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateContractFeeAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateContractFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateContractFeeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateContractFeeAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_ContractFee)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteContractFeeAction->execute($Id_ContractFee);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_ContractFee)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexContractFeeAction->execute($Id_ContractFee);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListContractFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListContractFeeAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchContractFeeRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchContractFeeDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchContractFeeAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}