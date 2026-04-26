<?php

namespace App\Application\TypeInstallment\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeInstallment\Repositories\ITypeInstallmentRepository;
use App\Domain\TypeInstallment\Enums\TypeInstallmentFilterDisplay;


class ListTypeInstallmentAction
{
	protected ITypeInstallmentRepository $oTypeInstallmentRepository;

	public function __construct(ITypeInstallmentRepository $oTypeInstallmentRepository)
	{
		$this->oTypeInstallmentRepository = $oTypeInstallmentRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeInstallmentRepository->getEntity();
		$oDisplay 	= TypeInstallmentFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeInstallmentRepository->list($oDisplay);
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