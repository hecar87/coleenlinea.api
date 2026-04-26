<?php

namespace App\Application\TypeKinship\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeKinship\Repositories\ITypeKinshipRepository;
use App\Application\TypeKinship\DTOs\UpdateTypeKinshipDTO;
use App\Application\TypeKinship\DTOs\DuplicatedTypeKinshipDTO;


class UpdateTypeKinshipAction
{
	protected ITypeKinshipRepository $oTypeKinshipRepository;

	public function __construct(ITypeKinshipRepository $oTypeKinshipRepository)
	{
		$this->oTypeKinshipRepository = $oTypeKinshipRepository;
	}

	public function execute(UpdateTypeKinshipDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeKinshipRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeKinshipDTO(
			Id_TypeKinship		: $oData->Id_TypeKinship,
			TypeKinship_Name	: $oData->TypeKinship_Name,
			TypeKinship_Abrv	: $oData->TypeKinship_Abrv
		);;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeKinshipRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeKinshipRepository->update($oData);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			DB::commit();
		}
		catch (\Exception $oException)
		{
			DB::rollBack();
			$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
}