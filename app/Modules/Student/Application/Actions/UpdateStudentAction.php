<?php

namespace App\Modules\Student\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Student\Domain\Repositories\IStudentRepository;
use App\Modules\TypeDocument\Domain\Repositories\ITypeDocumentRepository;

use App\Modules\Student\Application\DTOs\UpdateStudentDTO;
use App\Modules\Student\Application\DTOs\DuplicatedStudentDTO;


class UpdateStudentAction
{

	public function __construct(
		protected IStudentRepository $oStudentRepository,
		protected ITypeDocumentRepository $oTypeDocumentRepository
	)
	{
	}

	public function execute(UpdateStudentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oStudentRepository->getEntity();
		$oDataDuplicated = new DuplicatedStudentDTO(
			Id_Student : $oData->Id_Student,
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

			$oResult = $this->oTypeDocumentRepository->exists($oData->Id_TypeDocument);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oStudentRepository->exists($oData->Id_Student);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }


			$oResult = $this->oStudentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oStudentRepository->update($oData);
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