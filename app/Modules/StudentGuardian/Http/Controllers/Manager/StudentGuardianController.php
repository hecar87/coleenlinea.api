<?php
namespace App\Modules\StudentGuardian\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\StudentGuardian\Domain\Repositories\IStudentGuardianRepository;


// Requests
use App\Modules\StudentGuardian\Http\Requests\Manager\CreateStudentGuardianRequest;
use App\Modules\StudentGuardian\Http\Requests\Manager\UpdateStudentGuardianRequest;
use App\Modules\StudentGuardian\Http\Requests\Manager\ListStudentGuardianByGuardianRequest;
use App\Modules\StudentGuardian\Http\Requests\Manager\ListStudentGuardianByStudentRequest;
use App\Modules\StudentGuardian\Http\Requests\Manager\SearchStudentGuardianByGuardianRequest;
use App\Modules\StudentGuardian\Http\Requests\Manager\SearchStudentGuardianByStudentRequest;

// DTOs
use App\Modules\StudentGuardian\Application\DTOs\CreateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\UpdateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianByGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianByStudentDTO;

// Actions
use App\Modules\StudentGuardian\Application\Actions\CreateStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\UpdateStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\DeleteStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\IndexStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\ListStudentGuardianByGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\ListStudentGuardianByStudentAction;
use App\Modules\StudentGuardian\Application\Actions\SearchStudentGuardianByGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\SearchStudentGuardianByStudentAction;


class StudentGuardianController extends Controller
{
	protected IStudentGuardianRepository $repository;

	public function __construct(
		IStudentGuardianRepository $repository,

		private CreateStudentGuardianAction $oCreateStudentGuardianAction,
		private UpdateStudentGuardianAction $oUpdateStudentGuardianAction,
		private DeleteStudentGuardianAction $oDeleteStudentGuardianAction,
		private IndexStudentGuardianAction $oIndexStudentGuardianAction,
		private ListStudentGuardianByGuardianAction $oListStudentGuardianByGuardianAction,
		private ListStudentGuardianByStudentAction $oListStudentGuardianByStudentAction,
		private SearchStudentGuardianByGuardianAction $oSearchStudentGuardianByGuardianAction,
		private SearchStudentGuardianByStudentAction $oSearchStudentGuardianByStudentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateStudentGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateStudentGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateStudentGuardianAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateStudentGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateStudentGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateStudentGuardianAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_StudentGuardian)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteStudentGuardianAction->execute($Id_StudentGuardian);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_StudentGuardian)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexStudentGuardianAction->execute($Id_StudentGuardian);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function listByGuardian(int $Id_Guardian, ListStudentGuardianByGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListStudentGuardianByGuardianAction->execute($Id_Guardian, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function listByStudent(int $Id_Student, ListStudentGuardianByStudentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListStudentGuardianByStudentAction->execute($Id_Student, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function searchByGuardian(int $Id_Guardian, SearchStudentGuardianByGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchStudentGuardianByGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchStudentGuardianByGuardianAction->execute($Id_Guardian, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

	public function searchByStudent(int $Id_Guardian, SearchStudentGuardianByStudentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchStudentGuardianByStudentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchStudentGuardianByStudentAction->execute($Id_Guardian, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}