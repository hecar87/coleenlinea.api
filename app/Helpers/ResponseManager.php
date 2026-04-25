<?php

namespace App\Helpers;


class ResponseManager
{
	public static function Response($oResult, $oMetadata = null)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResponse	= array();
		$oResult	= $oResult[0];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResponse["date"]			= date("Y-m-d H:i:s");
		$oResponse["code"]			= $oResult->RESULT_COD;
		$oResponse["success"]		= $oResult->RESULT_STS == 200 ? true : false;
		$oResponse["domain"]		= $oResult->RESULT_DOM;
		$oResponse["message"]		= $oResult->RESULT_MSG;
		$oResponse["metadata"]		= SELF::Response_Metadata($oMetadata);
		$oResponse["data"]			= $oResult->RESULT_DTA;
		$oResponse["error"]			= $oResult->RESULT_ERR;


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return response()	->json($oResponse, $oResult->RESULT_STS);

	}


	private static function Response_Metadata($oMetadata)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResponse	= array();
		$oMetadata	= $oMetadata == null ? null : $oMetadata[0];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		if($oMetadata != null)
		{
			$oResponse["page-size"]			= $oMetadata->METADATA_PAGE_SZE;
			$oResponse["page-current"]		= $oMetadata->METADATA_PAGE_CUR;
			$oResponse["page-previous"]		= $oMetadata->METADATA_PAGE_PRV;
			$oResponse["page-next"]			= $oMetadata->METADATA_PAGE_NXT;
			$oResponse["data-total"]		= $oMetadata->METADATA_DATA_TTL;
			$oResponse["data-start"]		= $oMetadata->METADATA_DATA_STR;
			$oResponse["data-end"]			= $oMetadata->METADATA_DATA_END;
		}
		else
		{
			$oResponse = null;
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResponse;

	}
}