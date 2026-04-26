<?php

namespace App\Application\District\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\District\Repositories\IDistrictRepository;
use App\Domain\District\Enums\DistrictFilterDisplay;


class ListDistrictAction
{
	protected IDistrictRepository $oDistrictRepository;

	public function __construct(IDistrictRepository $oDistrictRepository)
	{
		$this->oDistrictRepository = $oDistrictRepository;
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