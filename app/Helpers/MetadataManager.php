<?php

namespace App\Helpers;


class MetadataManager
{
	public static function Metadata($Page_Size, $Page_Current, $Data_Total)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResult	= [];
		$Page_Size	= PaginationManager::Pagination_Size($Page_Size);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult	= array(
			(object)[
				"METADATA_PAGE_SZE"	=> $Page_Size,
				"METADATA_PAGE_CUR"	=> $Page_Current,
				"METADATA_PAGE_PRV"	=> SELF::Metadata_Page_Previous($Page_Current),
				"METADATA_PAGE_NXT"	=> SELF::Metadata_Page_Next($Page_Size, $Page_Current, $Data_Total),
				"METADATA_DATA_TTL"	=> $Data_Total,
				"METADATA_DATA_STR" => SELF::Metadata_Data_Start($Page_Size, $Page_Current),
				"METADATA_DATA_END" => SELF::Metadata_Data_End($Page_Size, $Page_Current, $Data_Total)
			]
		);


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}


	private static function Metadata_Page_Previous($Page_Current)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResult = false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		if($Page_Current > 1)
		{
			$oResult = true;
		}
		else
		{
			$oResult = false;
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
	private static function Metadata_Page_Next($Page_Size, $Page_Current, $Data_Total)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResult		= false;
		$Page_Size		= PaginationManager::Pagination_Size($Page_Size);
		$Page_Offset	= PaginationManager::Pagination_Offset($Page_Size, $Page_Current);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		if( ( $Page_Offset + $Page_Size ) >= $Data_Total )
		{
			$oResult = false;
		}
		else
		{
			$oResult = true;
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
	private static function Metadata_Data_Start($Page_Size, $Page_Current)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResult		= 0;
		$Page_Size		= PaginationManager::Pagination_Size($Page_Size);
		$Page_Offset	= PaginationManager::Pagination_Offset($Page_Size, $Page_Current);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$oResult = $Page_Offset + 1;


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
	private static function Metadata_Data_End($Page_Size, $Page_Current, $Data_Total)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResult		= 0;
		$Page_Size		= PaginationManager::Pagination_Size($Page_Size);
		$Page_Offset	= PaginationManager::Pagination_Offset($Page_Size, $Page_Current);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		if( ($Page_Offset + $Page_Size) >= $Data_Total )
		{
			$oResult = $Data_Total;
		}
		else
		{
			$oResult = $Page_Offset + $Page_Size;
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
}