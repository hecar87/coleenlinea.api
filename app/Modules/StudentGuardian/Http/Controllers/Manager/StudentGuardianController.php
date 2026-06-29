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
use App\Modules\StudentGuardian\Http\Requests\Manager\ListStudentGuardianRequest;
use App\Modules\StudentGuardian\Http\Requests\Manager\SearchStudentGuardianRequest;

// DTOs
use App\Modules\StudentGuardian\Application\DTOs\CreateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\UpdateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianDTO;

// Actions
use App\Modules\StudentGuardian\Application\Actions\CreateStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\UpdateStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\DeleteStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\IndexStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\ListStudentGuardianAction;
use App\Modules\StudentGuardian\Application\Actions\SearchStudentGuardianAction;


class StudentGuardianController extends Controller
{
	protected IStudentGuardianRepository $repository;

	public function __construct(
		IStudentGuardianRepository $repository,

		private CreateStudentGuardianAction $oCreateStudentGuardianAction,
		private UpdateStudentGuardianAction $oUpdateStudentGuardianAction,
		private DeleteStudentGuardianAction $oDeleteStudentGuardianAction,
		private IndexStudentGuardianAction $oIndexStudentGuardianAction,
		private ListStudentGuardianAction $oListStudentGuardianAction,
		private SearchStudentGuardianAction $oSearchStudentGuardianAction
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

	public function list(int $Id_School, ListStudentGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListStudentGuardianAction->execute($Id_School, $Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(int $Id_School, SearchStudentGuardianRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchStudentGuardianDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchStudentGuardianAction->execute($Id_School, $oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}