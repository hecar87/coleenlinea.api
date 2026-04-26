<?php

namespace App\Application\TypeLevel\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeLevel\Repositories\ITypeLevelRepository;
use App\Application\TypeLevel\DTOs\CreateTypeLevelDTO;
use App\Application\TypeLevel\DTOs\DuplicatedTypeLevelDTO;


class CreateTypeLevelAction
{
	protected ITypeLevelRepository $oTypeLevelRepository;

	public function __construct(ITypeLevelRepository $oTypeLevelRepository)
	{
		$this->oTypeLevelRepository = $oTypeLevelRepository;
	}

	public function execute(CreateTypeLevelDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeLevelRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeLevelDTO(
			Id_TypeLevel	: 0,
			TypeLevel_Name	: $oData->TypeLevel_Name,
			TypeLevel_Abrv	: $oData->TypeLevel_Abrv
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

			$oResult = $this->oTypeLevelRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeLevelRepository->create($oData);
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