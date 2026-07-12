<?php
namespace App\Modules\EnrollmentInstallment\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;


// Requests
use App\Modules\EnrollmentInstallment\Http\Requests\Manager\CreateEnrollmentInstallmentRequest;
use App\Modules\EnrollmentInstallment\Http\Requests\Manager\UpdateEnrollmentInstallmentRequest;
use App\Modules\EnrollmentInstallment\Http\Requests\Manager\ListEnrollmentInstallmentRequest;
use App\Modules\EnrollmentInstallment\Http\Requests\Manager\SearchEnrollmentInstallmentRequest;

// DTOs
use App\Modules\EnrollmentInstallment\Application\DTOs\CreateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\UpdateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\SearchEnrollmentInstallmentDTO;

// Actions
use App\Modules\EnrollmentInstallment\Application\Actions\CreateEnrollmentInstallmentAction;
use App\Modules\EnrollmentInstallment\Application\Actions\UpdateEnrollmentInstallmentAction;
use App\Modules\EnrollmentInstallment\Application\Actions\DeleteEnrollmentInstallmentAction;
use App\Modules\EnrollmentInstallment\Application\Actions\IndexEnrollmentInstallmentAction;
use App\Modules\EnrollmentInstallment\Application\Actions\ListEnrollmentInstallmentAction;
use App\Modules\EnrollmentInstallment\Application\Actions\SearchEnrollmentInstallmentAction;


class EnrollmentInstallmentController extends Controller
{
	protected IEnrollmentInstallmentRepository $repository;

	public function __construct(
		IEnrollmentInstallmentRepository $repository,

		private CreateEnrollmentInstallmentAction $oCreateEnrollmentInstallmentAction,
		private UpdateEnrollmentInstallmentAction $oUpdateEnrollmentInstallmentAction,
		private DeleteEnrollmentInstallmentAction $oDeleteEnrollmentInstallmentAction,
		private IndexEnrollmentInstallmentAction $oIndexEnrollmentInstallmentAction,
		private ListEnrollmentInstallmentAction $oListEnrollmentInstallmentAction,
		private SearchEnrollmentInstallmentAction $oSearchEnrollmentInstallmentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateEnrollmentInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateEnrollmentInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateEnrollmentInstallmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateEnrollmentInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateEnrollmentInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateEnrollmentInstallmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_EnrollmentInstallment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteEnrollmentInstallmentAction->execute($Id_EnrollmentInstallment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_EnrollmentInstallment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexEnrollmentInstallmentAction->execute($Id_EnrollmentInstallment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListEnrollmentInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListEnrollmentInstallmentAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchEnrollmentInstallmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchEnrollmentInstallmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchEnrollmentInstallmentAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}