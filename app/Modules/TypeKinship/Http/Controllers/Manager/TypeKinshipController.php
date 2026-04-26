<?php
namespace App\Http\Controllers\Manager\TypeKinship;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Domain\TypeKinship\Repositories\ITypeKinshipRepository;


// Requests
use App\Http\Controllers\Manager\TypeKinship\Requests\CreateTypeKinshipRequest;
use App\Http\Controllers\Manager\TypeKinship\Requests\UpdateTypeKinshipRequest;
use App\Http\Controllers\Manager\TypeKinship\Requests\ListTypeKinshipRequest;
use App\Http\Controllers\Manager\TypeKinship\Requests\SearchTypeKinshipRequest;

// DTOs
use App\Application\TypeKinship\DTOs\CreateTypeKinshipDTO;
use App\Application\TypeKinship\DTOs\UpdateTypeKinshipDTO;
use App\Application\TypeKinship\DTOs\SearchTypeKinshipDTO;

// Actions
use App\Application\TypeKinship\Actions\CreateTypeKinshipAction;
use App\Application\TypeKinship\Actions\UpdateTypeKinshipAction;
use App\Application\TypeKinship\Actions\DeleteTypeKinshipAction;
use App\Application\TypeKinship\Actions\IndexTypeKinshipAction;
use App\Application\TypeKinship\Actions\ListTypeKinshipAction;
use App\Application\TypeKinship\Actions\SearchTypeKinshipAction;


class TypeKinshipController extends Controller
{
	protected ITypeKinshipRepository $repository;

	public function __construct(
		ITypeKinshipRepository $repository,

		private CreateTypeKinshipAction $oCreateTypeKinshipAction,
		private UpdateTypeKinshipAction $oUpdateTypeKinshipAction,
		private DeleteTypeKinshipAction $oDeleteTypeKinshipAction,
		private IndexTypeKinshipAction $oIndexTypeKinshipAction,
		private ListTypeKinshipAction $oListTypeKinshipAction,
		private SearchTypeKinshipAction $oSearchTypeKinshipAction
	)
	{
		$this->repository = $repository;
	}


	public function create(CreateTypeKinshipRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = CreateTypeKinshipDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oCreateTypeKinshipAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function update(UpdateTypeKinshipRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = UpdateTypeKinshipDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oUpdateTypeKinshipAction->execute($oData);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function delete(int $Id_TypeKinship)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oDeleteTypeKinshipAction->execute($Id_TypeKinship);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function index(int $Id_TypeKinship)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oIndexTypeKinshipAction->execute($Id_TypeKinship);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;

	}

	public function list(ListTypeKinshipRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$Display    = $oRequest->input('Display', 'ALL');


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oListTypeKinshipAction->execute($Display);
		$oResponse 	= ResponseManager::Response($oResult);

		return $oResponse;
	}

	public function search(SearchTypeKinshipRequest $oRequest)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oData = SearchTypeKinshipDTO::fromRequest($oRequest);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= $this->oSearchTypeKinshipAction->execute($oData);
		$oMetadata	= MetadataManager::Metadata($oData->Page_Size, $oData->Page_Current, $oResult->RESULT_DTL);
		$oResponse 	= ResponseManager::Response($oResult, $oMetadata);

		return $oResponse;

	}

}