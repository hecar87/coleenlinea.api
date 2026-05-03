<?php

namespace App\Modules\TypeGender\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeGender\Repositories\ITypeGenderRepository;
use App\Domain\TypeGender\Enums\TypeGenderFilterDisplay;


class ListTypeGenderAction
{
	protected ITypeGenderRepository $oTypeGenderRepository;

	public function __construct(ITypeGenderRepository $oTypeGenderRepository)
	{
		$this->oTypeGenderRepository = $oTypeGenderRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeGenderRepository->getEntity();
		$oDisplay 	= TypeGenderFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeGenderRepository->list($oDisplay);
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