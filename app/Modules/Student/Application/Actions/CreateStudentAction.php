<?php

namespace App\Modules\Student\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Student\Domain\Repositories\IStudentRepository;
use App\Modules\TypeDocument\Domain\Repositories\ITypeDocumentRepository;
use App\Modules\TypeGender\Domain\Repositories\ITypeGenderRepository;

use App\Modules\Student\Application\DTOs\CreateStudentDTO;
use App\Modules\Student\Application\DTOs\DuplicatedStudentDTO;


class CreateStudentAction
{

	public function __construct(
		protected IStudentRepository $oStudentRepository,
		protected ITypeDocumentRepository $oTypeDocumentRepository,
		protected ITypeGenderRepository $oTypeGenderRepository
	)
	{
	}

	public function execute(CreateStudentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oStudentRepository->getEntity();
		$oDataDuplicated = new DuplicatedStudentDTO(
			Id_Student	: 0,
			Student_NoDocument : $oData->Student_NoDocument,
			Id_TypeDocument : $oData->Id_TypeDocument
		);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oStateRepository->exists($oData->Id_State);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oCityRepository->exists($oData->Id_City);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oDistrictRepository->exists($oData->Id_District);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oTypeDocumentRepository->exists($oData->Id_TypeDocument);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oTypeGenderRepository->exists($oData->Id_TypePopulation);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oTypeStudentRepository->exists($oData->Id_TypeStudent);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }


			$oResult = $this->oStudentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oStudentRepository->create($oData);
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