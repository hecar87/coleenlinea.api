<?php

namespace App\Modules\SchoolProfile\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\TypeBank\Domain\Repositories\ITypeBankRepository;
use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;

use App\Modules\SchoolProfile\Application\DTOs\UpdateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\DuplicatedSchoolProfileDTO;


class UpdateSchoolProfileAction
{

	public function __construct(
		protected ISchoolProfileRepository $oSchoolProfileRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ITypeBankRepository $oTypeBankRepository,
		protected ITypeCurrencyRepository $oTypeCurrencyRepository
	)
	{
	}

	public function execute(UpdateSchoolProfileDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolProfileRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolProfileDTO(
			Id_SchoolProfile		: $oData->Id_SchoolProfile,
			SchoolProfile_Number	: $oData->SchoolProfile_Number,
            SchoolProfile_CCI		: $oData->SchoolProfile_CCI,
            Id_School				: $oData->Id_School,
            Id_TypeBank				: $oData->Id_TypeBank,
            Id_TypeCurrency			: $oData->Id_TypeCurrency
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

			$oResult = $this->oSchoolRepository->exists($oData->Id_School);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oTypeBankRepository->exists($oData->Id_TypeBank);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->exists($oData->Id_TypeCurrency);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oSchoolProfileRepository->exists($oData->Id_SchoolProfile);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oSchoolProfileRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolProfileRepository->update($oData);
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