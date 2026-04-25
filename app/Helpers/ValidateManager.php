<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ValidateManager
{
	public static function Validate_Request(Request $oRequest, $oRules, $Entity)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResult        = array();
		$oValidation    = Validator::make($oRequest->all(), $oRules);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		if( !$oValidation->fails() )
		{
			$oResult = ResultManager::Result(1000, $Entity);
		}
		else
		{
			$oResult = ResultManager::Result(2101, $Entity, null, 0, $oValidation->errors());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
}