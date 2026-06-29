<?php
namespace App\Modules\Student\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\Student\Domain\Repositories\IStudentRepository;


// Requests
use App\Modules\Student\Http\Requests\Manager\CreateStudentRequest;
use App\Modules\Student\Http\Requests\Manager\UpdateStudentRequest;
use App\Modules\Student\Http\Requests\Manager\ListStudentRequest;
use App\Modules\Student\Http\Requests\Manager\SearchStudentRequest;

// DTOs
use App\Modules\Student\Application\DTOs\CreateStudentDTO;
use App\Modules\Student\Application\DTOs\UpdateStudentDTO;
use App\Modules\Student\Application\DTOs\SearchStudentDTO;

// Actions
use App\Modules\Student\Application\Actions\CreateStudentAction;
use App\Modules\Student\Application\Actions\UpdateStudentAction;
use App\Modules\Student\Application\Actions\DeleteStudentAction;
use App\Modules\Student\Application\Actions\IndexStudentAction;
use App\Modules\Student\Application\Actions\ListStudentAction;
use App\Modules\Student\Application\Actions\SearchStudentAction;
use App\Modules\Student\Application\Actions\VerifyStudentAction;
use App\Modules\Student\Application\Actions\ActivateStudentAction;
use App\Modules\Student\Application\Actions\DeactivateStudentAction;


class StudentController extends Controller
{
	protected IStudentRepository $repository;

	public function __construct(
		IStudentRepository $repository,

		private CreateStudentAction $oCreateStudentAction,
		private UpdateStudentAction $oUpdateStudentAction,
		private DeleteStudentAction $oDeleteStudentAction,
		private IndexStudentAction $oIndexStudentAction,
		private ListStudentAction $oListStudentAction,
		private SearchStudentAction $oSearchStudentAction,
		private VerifyStudentAction $oVerifyStudentAction,
		private ActivateStudentAction $oActivateStudentAction,
		private DeactivateStudentAction $oDeactivateStudentAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateStudentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateStudentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateStudentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateStudentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateStudentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateStudentAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_Student)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteStudentAction->execute($Id_Student);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_Student)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexStudentAction->execute($Id_Student);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListStudentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListStudentAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchStudentRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchStudentDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchStudentAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

	public function verify(int $Id_Student)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oVerifyStudentAction->execute($Id_Student);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function activate(int $Id_Student)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oActivateStudentAction->execute($Id_Student);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function deactivate(int $Id_Student)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeactivateStudentAction->execute($Id_Student);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

}