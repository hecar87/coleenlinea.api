<?php

namespace App\Modules\District\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\District\Domain\Repositories\IDistrictRepository;
use App\Modules\City\Domain\Repositories\ICityRepository;

use App\Modules\District\Domain\Enums\DistrictFilterDisplay;


class ListDistrictAction
{

	public function __construct(
		protected IDistrictRepository $oDistrictRepository,
		protected ICityRepository $oCityRepository
	)
	{
	}

	public function execute(int $Id_City, string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oDistrictRepository->getEntity();
		$oDisplay 	= DistrictFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oCityRepository->exists($Id_City);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oDistrictRepository->list($Id_City, $oDisplay);
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