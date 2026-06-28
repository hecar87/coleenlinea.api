<?php

namespace App\Modules\Contract\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Contract\Domain\Repositories\IContractRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;

use App\Modules\Contract\Application\DTOs\SearchContractDTO;


class SearchContractAction
{

	public function __construct(
		protected IContractRepository $oContractRepository,
		protected ISchoolRepository $oSchoolRepository
	)
	{
	}

	public function execute(int $Id_School, SearchContractDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oContractRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oresult = $this->oSchoolRepository->exists($Id_School);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oContractRepository->search($Id_School, $oData);
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