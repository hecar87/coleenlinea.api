<?php

namespace App\Application\TypeGender\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeGender\Repositories\ITypeGenderRepository;
use App\Application\TypeGender\DTOs\CreateTypeGenderDTO;
use App\Application\TypeGender\DTOs\DuplicatedTypeGenderDTO;


class CreateTypeGenderAction
{
	protected ITypeGenderRepository $oTypeGenderRepository;

	public function __construct(ITypeGenderRepository $oTypeGenderRepository)
	{
		$this->oTypeGenderRepository = $oTypeGenderRepository;
	}

	public function execute(CreateTypeGenderDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeGenderRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeGenderDTO(
			Id_TypeGender	: 0,
			TypeGender_Name	: $oData->TypeGender_Name,
			TypeGender_Abrv	: $oData->TypeGender_Abrv
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

			$oResult = $this->oTypeGenderRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeGenderRepository->create($oData);
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