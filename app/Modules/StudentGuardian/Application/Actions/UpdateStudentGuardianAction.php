<?php

namespace App\Modules\StudentGuardian\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\StudentGuardian\Domain\Repositories\IStudentGuardianRepository;
use App\Modules\Student\Domain\Repositories\IStudentRepository;
use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;
use App\Modules\TypeKinship\Domain\Repositories\ITypeKinshipRepository;

use App\Modules\StudentGuardian\Application\DTOs\UpdateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\DuplicatedStudentGuardianDTO;


class UpdateStudentGuardianAction
{

	public function __construct(
		protected IStudentGuardianRepository $oStudentGuardianRepository,
		protected IStudentRepository $oStudentRepository,
		protected IGuardianRepository $oGuardianRepository,
		protected ITypeKinshipRepository $oTypeKinshipRepository
	)
	{
	}

	public function execute(UpdateStudentGuardianDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oStudentGuardianRepository->getEntity();
		$oDataDuplicated = new DuplicatedStudentGuardianDTO(
			Id_StudentGuardian	: $oData->Id_StudentGuardian,
			Id_Student			: $oData->Id_Student,
			Id_Guardian			: $oData->Id_Guardian,
			Id_TypeKinship		: $oData->Id_TypeKinship
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

			$oResult = $this->oStudentRepository->exists($oData->Id_Student);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oGuardianRepository->exists($oData->Id_Guardian);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeKinshipRepository->exists($oData->Id_TypeKinship);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oStudentGuardianRepository->exists($oData->Id_StudentGuardian);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oStudentGuardianRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oStudentGuardianRepository->update($oData);
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