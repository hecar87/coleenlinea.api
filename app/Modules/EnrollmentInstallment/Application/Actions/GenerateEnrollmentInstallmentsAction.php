<?php

namespace App\Modules\EnrollmentInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;
use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\SchoolClass\Domain\Repositories\ISchoolClassRepository;
use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;
use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;

use App\Modules\TypeInstallment\Domain\Enums\TypeInstallmentFrequency;

use App\Modules\EnrollmentInstallment\Application\DTOs\CreateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\DuplicatedEnrollmentInstallmentDTO;


class GenerateEnrollmentInstallmentsAction
{

	public function __construct(
		protected IEnrollmentInstallmentRepository $oEnrollmentInstallmentRepository,
		protected IEnrollmentRepository $oEnrollmentRepository,
		protected ISchoolClassRepository $oSchoolClassRepository,
        protected ISchoolProfileRepository $oSchoolProfileRepository,
        protected ISchoolInstallmentRepository $oSchoolInstallmentRepository
	)
	{
	}

	public function execute(int $Id_Enrollment) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentInstallmentRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			// Enrollment
			//
			$oResult = $this->oEnrollmentRepository->index($Id_Enrollment);
			if ($oResult->RESULT_STS <> 200) { return $oResult; }

			$oEnrollment = $oResult->RESULT_DTA[0];


			//
			// School Class
			//
			$oResult = $this->oSchoolClassRepository->index( $oEnrollment->Id_SchoolClass );
			if ($oResult->RESULT_STS <> 200) { return $oResult; }

			$oSchoolClass = $oResult->RESULT_DTA[0];


			//
			// School Profile
			//
			$oResult = $this->oSchoolProfileRepository->find(
				$oEnrollment->Id_School,
				$oEnrollment->Id_SchoolYear,
				$oSchoolClass->Id_SchoolLevel,
				$oEnrollment->Enrollment_Newed,
				$oEnrollment->Enrollment_Type
			);
			if ($oResult->RESULT_STS <> 200) { return $oResult; }

			$oSchoolProfile = $oResult->RESULT_DTA[0];


			//
			// Installments
			//
			$oResult = $this->oSchoolInstallmentRepository->list( $oSchoolProfile->Id_SchoolProfile );
			if ($oResult->RESULT_STS <> 200) { return $oResult; }

			$oResult = $this->generateInstallments($oEnrollment, $oResult->RESULT_DTA);
			if ($oResult->RESULT_STS <> 200) { return $oResult; }
		}
		catch (\Throwable $oException)
		{
			$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}


	private function generateInstallments( object $oEnrollment, object $oSchoolInstallments) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentInstallmentRepository->getEntity();
		$oResult = [];

		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			foreach ($oSchoolInstallments as $oSchoolInstallment)
			{
				switch ($oSchoolInstallment->TypeInstallment_Frequency)
				{
					case TypeInstallmentFrequency::YEARLY->value:
						$oResult = $this->generateYearlyInstallment($oEnrollment, $oSchoolInstallment);
						break;

					case TypeInstallmentFrequency::MONTHLY->value:
						$oResult = $this->generateMonthlyInstallments( $oEnrollment, $oSchoolInstallment );
						break;

					default:
						$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, "Frecuencia de cuota no soportada");

				}

				if ($oResult->RESULT_STS <> 200)
				{
					return $oResult;
				}
			}
			$oResult 	= ResultManager::Result(1000, $oEntity, null);
		}
		catch (\Throwable $oException)
		{
			$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	private function generateYearlyInstallment( object $oEnrollment, object $oSchoolInstallment ): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oEnrollmentInstallmentRepository->getEntity();
		$oResult 	= [];
		$oData		= new CreateEnrollmentInstallmentDTO(
	        Id_EnrollmentInstallment: 0,
			EnrollmentInstallment_Order: 1,
			EnrollmentInstallment_Description: $oSchoolInstallment->TypeInstallment_Name,
			EnrollmentInstallment_Amount_Budgeted: $oSchoolInstallment->SchoolInstallment_Amount,
			EnrollmentInstallment_Amount_Discounted: 0,
			EnrollmentInstallment_Amount_Payabled: $oSchoolInstallment->SchoolInstallment_Amount,
			EnrollmentInstallment_Date_Collection: $oSchoolInstallment->SchoolInstallment_Date_Start,
			EnrollmentInstallment_Date_Due: $oSchoolInstallment->SchoolInstallment_Date_End,
			EnrollmentInstallment_Required: $oSchoolInstallment->SchoolInstallment_Required,
			Id_Enrollment: $oEnrollment->Id_Enrollment,
			Id_TypeCurrency: $oSchoolInstallment->Id_TypeCurrency,
			Id_TypeInstallment: $oSchoolInstallment->Id_TypeInstallment
		);

		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			$oResult = $this->oEnrollmentInstallmentRepository->create($oData);
			if ( $oResult->RESULT_STS <> 200 ){ return $oResult; }
		}
		catch (\Throwable $oException)
		{
			$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	private function generateMonthlyInstallments( object $oEnrollment, object $oSchoolInstallment ): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oEnrollmentInstallmentRepository->getEntity();
		$oResult 	= [];

		$DateCollection = Carbon::parse( $oSchoolInstallment->SchoolInstallment_Date_Start );
		$DateDue 		= Carbon::parse( $oSchoolInstallment->SchoolInstallment_Date_End );
    	$Period 		= CarbonPeriod::create( $DateCollection->copy()->startOfMonth(), '1 month', $DateDue->copy()->startOfMonth() );
		$Order 			= 1;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			foreach ($Period as $Month)
			{
				//
				// Fechas
				//
				$CollectionDate = $Month->copy()->day( $DateCollection->day );
				$DueDate = $Month->copy()->day( $DateDue->day );

				//
				// Descripción
				//
				$Description = $Month->translatedFormat('F Y');

				//
				// DTO
				//
				$oDTO = new CreateEnrollmentInstallmentDTO(
					Id_EnrollmentInstallment: 0,
					EnrollmentInstallment_Order: $Order,
					EnrollmentInstallment_Description: $Description,
					EnrollmentInstallment_Amount_Budgeted: $oSchoolInstallment->SchoolInstallment_Amount,
					EnrollmentInstallment_Amount_Discounted: 0,
					EnrollmentInstallment_Amount_Payabled: $oSchoolInstallment->SchoolInstallment_Amount,
					EnrollmentInstallment_Date_Collection: $CollectionDate->toDateString(),
					EnrollmentInstallment_Date_Due: $DueDate->toDateString(),
					EnrollmentInstallment_Required: $oSchoolInstallment->SchoolInstallment_Required,
					Id_Enrollment: $oEnrollment->Id_Enrollment,
					Id_TypeCurrency: $oSchoolInstallment->Id_TypeCurrency,
					Id_TypeInstallment: $oSchoolInstallment->Id_TypeInstallment
				);

				$oResult = $this->oEnrollmentInstallmentRepository->create($oDTO);
				if ($oResult->RESULT_STS <> 200) { return $oResult; }

				$Order++;
			}

			$oResult 	= ResultManager::Result(1000, $oEntity, null);
		}
		catch (\Throwable $oException)
		{
			$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}