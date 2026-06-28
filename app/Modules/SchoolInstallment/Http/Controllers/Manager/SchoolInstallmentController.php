<?php
namespace App\Modules\SchoolInstallment\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;


// Requests
use App\Modules\SchoolInstallment\Http\Requests\Manager\CreateSchoolInstallmentRequest;
use App\Modules\SchoolInstallment\Http\Requests\Manager\UpdateSchoolInstallmentRequest;
use App\Modules\SchoolInstallment\Http\Requests\Manager\ListSchoolInstallmentRequest;
use App\Modules\SchoolInstallment\Http\Requests\Manager\SearchSchoolInstallmentRequest;

// DTOs
use App\Modules\SchoolInstallment\Application\DTOs\CreateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\UpdateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\SearchSchoolInstallmentDTO;

// Actions
use App\Modules\SchoolInstallment\Application\Actions\CreateSchoolInstallmentAction;
use App\Modules\SchoolInstallment\Application\Actions\UpdateSchoolInstallmentAction;
use App\Modules\SchoolInstallment\Application\Actions\DeleteSchoolInstallmentAction;
use App\Modules\SchoolInstallment\Application\Actions\IndexSchoolInstallmentAction;
use App\Modules\SchoolInstallment\Application\Actions\ListSchoolInstallmentAction;
use App\Modules\SchoolInstallment\Application\Actions\SearchSchoolInstallmentAction;


class SchoolInstallmentController extends Controller
{
	protected ISchoolInstallmentRepository $repository;

	public function __construct(
		ISchoolInstallmentRepository $repository,

		private CreateSchoolInstallmentAction $oCreateSchoolInstallmentAction,
		private UpdateSchoolInstallmentAction $oUpdateSchoolInstallmentAction,
		private DeleteSchoolInstallmentAction $oDeleteSchoolInstallmentAction,
		private IndexSchoolInstallmentAction $oIndexSchoolInstallmentAction,
		private ListSchoolInstallmentAction $oListSchoolInstallmentAction,
		private SearchSchoolInstallmentAction $oSearchSchoolInstallmentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateSchoolInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateSchoolInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateSchoolInstallmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateSchoolInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateSchoolInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateSchoolInstallmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_SchoolInstallment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteSchoolInstallmentAction->execute($Id_SchoolInstallment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_SchoolInstallment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexSchoolInstallmentAction->execute($Id_SchoolInstallment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_SchoolYear, ListSchoolInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListSchoolInstallmentAction->execute($Id_SchoolYear, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_SchoolYear, SearchSchoolInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchSchoolInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchSchoolInstallmentAction->execute($Id_SchoolYear, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}