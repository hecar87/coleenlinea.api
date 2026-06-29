<?php
namespace App\Modules\Enrollment\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;


// Requests
use App\Modules\Enrollment\Http\Requests\Manager\CreateEnrollmentRequest;
use App\Modules\Enrollment\Http\Requests\Manager\UpdateEnrollmentRequest;
use App\Modules\Enrollment\Http\Requests\Manager\ListEnrollmentRequest;
use App\Modules\Enrollment\Http\Requests\Manager\SearchEnrollmentRequest;

// DTOs
use App\Modules\Enrollment\Application\DTOs\CreateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentDTO;

// Actions
use App\Modules\Enrollment\Application\Actions\CreateEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\UpdateEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\DeleteEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\IndexEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\ListEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\SearchEnrollmentAction;


class EnrollmentController extends Controller
{
	protected IEnrollmentRepository $repository;

	public function __construct(
		IEnrollmentRepository $repository,

		private CreateEnrollmentAction $oCreateEnrollmentAction,
		private UpdateEnrollmentAction $oUpdateEnrollmentAction,
		private DeleteEnrollmentAction $oDeleteEnrollmentAction,
		private IndexEnrollmentAction $oIndexEnrollmentAction,
		private ListEnrollmentAction $oListEnrollmentAction,
		private SearchEnrollmentAction $oSearchEnrollmentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateEnrollmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateEnrollmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateEnrollmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateEnrollmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateEnrollmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateEnrollmentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_Enrollment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteEnrollmentAction->execute($Id_Enrollment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_Enrollment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexEnrollmentAction->execute($Id_Enrollment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(int $Id_School, ListEnrollmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListEnrollmentAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchEnrollmentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchEnrollmentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchEnrollmentAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}