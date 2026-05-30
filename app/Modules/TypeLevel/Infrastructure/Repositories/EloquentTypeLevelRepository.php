<?php

namespace App\Modules\TypeLevel\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeLevel\Domain\Repositories\ITypeLevelRepository;
use App\Modules\TypeLevel\Infrastructure\Persistence\EloquentTypeLevel as TypeLevelModel;

use App\Modules\TypeLevel\Application\DTOs\CreateTypeLevelDTO;
use App\Modules\TypeLevel\Application\DTOs\UpdateTypeLevelDTO;
use App\Modules\TypeLevel\Application\DTOs\DuplicatedTypeLevelDTO;
use App\Modules\TypeLevel\Application\DTOs\SearchTypeLevelDTO;

use App\Modules\TypeLevel\Domain\Enums\TypeLevelFilterDisplay;
use App\Modules\TypeLevel\Domain\Enums\TypeLevelFilterStatus;
use App\Modules\TypeLevel\Domain\Enums\TypeLevelPublic;
use App\Modules\TypeLevel\Domain\Enums\TypeLevelStatus;


class EloquentTypeLevelRepository implements ITypeLevelRepository
{
	public function getEntity(): string
	{
		return TypeLevelModel::getEntity();
	}

	public function exists(int $Id_TypeLevel) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeLevelModel::query();

			$oQuery->where("Id_TypeLevel", "=", $Id_TypeLevel);
			$oQuery->where("TypeLevel_Status", "<>", "0");

			$exists = $oQuery->count();


			//
			//	FUNCTION
			//
			if ( $exists == 1 )
			{
				$oResult = ResultManager::Result(1000, $oEntity);
			}
			else
			{
				$oResult = ResultManager::Result(2200, $oEntity);
			}
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }
    public function duplicated(DuplicatedTypeLevelDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeLevelModel::query();

			$oQuery->where("Id_TypeLevel", "<>", $dto->Id_TypeLevel);
			$oQuery->where("TypeLevel_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeLevel_Name", "=", $dto->TypeLevel_Name );
				$oSubQuery->orWhere	( "TypeLevel_Abrv", "=", $dto->TypeLevel_Abrv );
			});

			$Duplicate	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ( $Duplicate == 0 )
			{
				$oResult = ResultManager::Result(1000, $oEntity);
			}
			else
			{
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }
    public function create(CreateTypeLevelDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeLevelModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeLevel"		=> $dto->Id_TypeLevel,
				"TypeLevel_Name"	=> trim( mb_strtoupper( $dto->TypeLevel_Name, "utf-8" ) ),
				"TypeLevel_Abrv"	=> trim( mb_strtoupper( $dto->TypeLevel_Abrv, "utf-8" ) ),
				"TypeLevel_Public"	=> $dto->TypeLevel_Public,
				"TypeLevel_Status"	=> $dto->TypeLevel_Status
			]);

			$oQuery->where("Id_TypeLevel", "=", "$Id");
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1001, $oEntity, $oData);
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }
    public function update(UpdateTypeLevelDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//´
			$oQuery	= TypeLevelModel::query();

			$oQuery->where("Id_TypeLevel", "=", $dto->Id_TypeLevel);
			$oQuery->update([
				"TypeLevel_Name"	=> trim( mb_strtoupper( $dto->TypeLevel_Name, "utf-8" ) ),
				"TypeLevel_Abrv"	=> trim( mb_strtoupper( $dto->TypeLevel_Abrv, "utf-8" ) ),
				"TypeLevel_Public"	=> $dto->TypeLevel_Public,
				"TypeLevel_Status"	=> $dto->TypeLevel_Status
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1002, $oEntity, $oData);
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }
    public function delete(int $Id_TypeLevel) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeLevelModel::query();

			$oQuery->where("Id_TypeLevel", "=", $Id_TypeLevel);
			$oQuery->update([
				"TypeLevel_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeLevel_Name)"),
				"TypeLevel_Status"	=> 0
			]);


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1003, $oEntity);
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }
    public function index(int $Id_TypeLevel) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeLevelModel::query();

			$oQuery->where("Id_TypeLevel", "=", $Id_TypeLevel);
			$oQuery->where("TypeLevel_Status", "<>", "0");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1004, $oEntity, $oData);
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }
    public function list(TypeLevelFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	SET VARIABLES
			//
			$whereDisplay	= [
                TypeLevelFilterDisplay::PUBLIC->value  => 2,
                TypeLevelFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeLevelModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeLevel_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeLevel_Status', '=', TypeLevelStatus::ACTIVE->value);
			$oQuery->orderBy("TypeLevel_Name", "ASC");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1005, $oEntity, $oData);
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }
    public function search(SearchTypeLevelDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	SET VARIABLES
			//
			$Page_Current	= $dto->Page_Current;
			$Page_Size		= PaginationManager::Pagination_Size($dto->Page_Size);
			$Page_Offset	= PaginationManager::Pagination_Offset($Page_Size, $Page_Current);

            $whereDisplay	= [
                TypeLevelFilterDisplay::PUBLIC->value  => 2,
                TypeLevelFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeLevelFilterStatus::ACTIVE->value   => 2,
                TypeLevelFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeLevelModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeLevel_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeLevel_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeLevel_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	("TypeLevel_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeLevel_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeLevel_Name", "ASC");
			$oQuery->limit($Page_Size);
			$oQuery->offset($Page_Offset);

			// GET DATA
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1006, $oEntity, $oData, $Data_Total);
		}
		catch(\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

    }

}