<?php

namespace App\Modules\TypeInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeInstallment\Domain\Repositories\ITypeInstallmentRepository;
use App\Modules\TypeInstallment\Application\DTOs\SearchTypeInstallmentDTO;


class SearchTypeInstallmentAction
{
	protected ITypeInstallmentRepository $oTypeInstallmentRepository;

	public function __construct(ITypeInstallmentRepository $oTypeInstallmentRepository)
	{
		$this->oTypeInstallmentRepository = $oTypeInstallmentRepository;
	}

	public function execute(SearchTypeInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeInstallmentRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeInstallmentRepository->search($oData);
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