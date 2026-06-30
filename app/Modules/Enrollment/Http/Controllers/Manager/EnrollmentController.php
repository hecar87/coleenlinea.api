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
use App\Modules\Enrollment\Http\Requests\Manager\SearchEnrollmentBySchoolClassRequest;
use App\Modules\Enrollment\Http\Requests\Manager\SearchEnrollmentBySchoolYearRequest;
use App\Modules\Enrollment\Http\Requests\Manager\SearchEnrollmentByStudentRequest;

// DTOs
use App\Modules\Enrollment\Application\DTOs\CreateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolClassDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolYearDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentByStudentDTO;

// Actions
use App\Modules\Enrollment\Application\Actions\CreateEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\UpdateEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\DeleteEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\IndexEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\ListEnrollmentBySchoolClassAction;
use App\Modules\Enrollment\Application\Actions\ListEnrollmentByStudentAction;
use App\Modules\Enrollment\Application\Actions\SearchEnrollmentBySchoolClassAction;
use App\Modules\Enrollment\Application\Actions\SearchEnrollmentBySchoolYearAction;
use App\Modules\Enrollment\Application\Actions\SearchEnrollmentByStudentAction;
use App\Modules\Enrollment\Application\Actions\EnrollEnrollmentAction;
use App\Modules\Enrollment\Application\Actions\NullifyEnrollmentAction;


class EnrollmentController extends Controller
{
	protected IEnrollmentRepository $repository;

	public function __construct(
		IEnrollmentRepository $repository,

		private CreateEnrollmentAction $oCreateEnrollmentAction,
		private UpdateEnrollmentAction $oUpdateEnrollmentAction,
		private DeleteEnrollmentAction $oDeleteEnrollmentAction,
		private IndexEnrollmentAction $oIndexEnrollmentAction,
		private ListEnrollmentBySchoolClassAction $oListEnrollmentBySchoolClassAction,
		private ListEnrollmentByStudentAction $oListEnrollmentByStudentAction,
		private SearchEnrollmentBySchoolClassAction $oSearchEnrollmentBySchoolClassAction,
		private SearchEnrollmentBySchoolYearAction $oSearchEnrollmentBySchoolYearAction,
		private SearchEnrollmentByStudentAction $oSearchEnrollmentByStudentAction,
		private EnrollEnrollmentAction $oEnrollEnrollmentAction,
		private NullifyEnrollmentAction $oNullifyEnrollmentAction
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

	public function listBySchoolClass(int $Id_SchoolClass)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListEnrollmentBySchoolClassAction->execute($Id_SchoolClass);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function listByStudent(int $Id_Student)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListEnrollmentByStudentAction->execute($Id_Student);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function searchBySchoolClass(int $Id_SchoolClass, SearchEnrollmentBySchoolClassRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchEnrollmentBySchoolClassDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchEnrollmentBySchoolClassAction->execute($Id_SchoolClass, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

	public function searchBySchoolYear(int $Id_SchoolYear, SearchEnrollmentBySchoolYearRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchEnrollmentBySchoolYearDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchEnrollmentBySchoolYearAction->execute($Id_SchoolYear, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

	public function searchByStudent(int $Id_Student, SearchEnrollmentByStudentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchEnrollmentByStudentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchEnrollmentByStudentAction->execute($Id_Student, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

	public function enroll(int $Id_Enrollment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oEnrollEnrollmentAction->execute($Id_Enrollment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function nullify(int $Id_Enrollment)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oNullifyEnrollmentAction->execute($Id_Enrollment);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

}