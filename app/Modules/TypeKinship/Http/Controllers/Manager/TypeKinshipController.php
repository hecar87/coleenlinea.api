<?php

namespace App\Modules\TypeKinship\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Helpers\Result;
use App\Helpers\ResponseManager;
use App\Helpers\MetadataManager;
use App\Modules\TypeKinship\Domain\Repositories\ITypeKinshipRepository;


// Requests
use App\Modules\TypeKinship\Http\Requests\Manager\CreateTypeKinshipRequest;
use App\Modules\TypeKinship\Http\Requests\Manager\UpdateTypeKinshipRequest;
use App\Modules\TypeKinship\Http\Requests\Manager\ListTypeKinshipRequest;
use App\Modules\TypeKinship\Http\Requests\Manager\SearchTypeKinshipRequest;

// DTOs
use App\Modules\TypeKinship\Application\DTOs\CreateTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\UpdateTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\SearchTypeKinshipDTO;

// Actions
use App\Modules\TypeKinship\Application\Actions\CreateTypeKinshipAction;
use App\Modules\TypeKinship\Application\Actions\UpdateTypeKinshipAction;
use App\Modules\TypeKinship\Application\Actions\DeleteTypeKinshipAction;
use App\Modules\TypeKinship\Application\Actions\IndexTypeKinshipAction;
use App\Modules\TypeKinship\Application\Actions\ListTypeKinshipAction;
use App\Modules\TypeKinship\Application\Actions\SearchTypeKinshipAction;


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