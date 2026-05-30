<?php

namespace App\Modules\TypeGender\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeGender\Domain\Repositories\ITypeGenderRepository;
use App\Modules\TypeGender\Infrastructure\Persistence\EloquentTypeGender as TypeGenderModel;

use App\Modules\TypeGender\Application\DTOs\CreateTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\UpdateTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\DuplicatedTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\SearchTypeGenderDTO;

use App\Modules\TypeGender\Domain\Enums\TypeGenderFilterDisplay;
use App\Modules\TypeGender\Domain\Enums\TypeGenderFilterStatus;
use App\Modules\TypeGender\Domain\Enums\TypeGenderPublic;
use App\Modules\TypeGender\Domain\Enums\TypeGenderStatus;


class EloquentTypeGenderRepository implements ITypeGenderRepository
{
	public function getEntity(): string
	{
		return TypeGenderModel::getEntity();
	}

	public function exists(int $Id_TypeGender) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
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
			$oQuery	= TypeGenderModel::query();

			$oQuery->where("Id_TypeGender", "=", $Id_TypeGender);
			$oQuery->where("TypeGender_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeGenderDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
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
			$oQuery	= TypeGenderModel::query();

			$oQuery->where("Id_TypeGender", "<>", $dto->Id_TypeGender);
			$oQuery->where("TypeGender_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeGender_Name", "=", $dto->TypeGender_Name );
				$oSubQuery->orWhere	( "TypeGender_Abrv", "=", $dto->TypeGender_Abrv );
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
    public function create(CreateTypeGenderDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
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
			$oQuery	= TypeGenderModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeGender"		=> $dto->Id_TypeGender,
				"TypeGender_Name"	=> trim( mb_strtoupper( $dto->TypeGender_Name, "utf-8" ) ),
				"TypeGender_Abrv"	=> trim( mb_strtoupper( $dto->TypeGender_Abrv, "utf-8" ) ),
				"TypeGender_Public"	=> $dto->TypeGender_Public,
				"TypeGender_Status"	=> $dto->TypeGender_Status
			]);

			$oQuery->where("Id_TypeGender", "=", "$Id");
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
    public function update(UpdateTypeGenderDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
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
			$oQuery	= TypeGenderModel::query();

			$oQuery->where("Id_TypeGender", "=", $dto->Id_TypeGender);
			$oQuery->update([
				"TypeGender_Name"	=> trim( mb_strtoupper( $dto->TypeGender_Name, "utf-8" ) ),
				"TypeGender_Abrv"	=> trim( mb_strtoupper( $dto->TypeGender_Abrv, "utf-8" ) ),
				"TypeGender_Public"	=> $dto->TypeGender_Public,
				"TypeGender_Status"	=> $dto->TypeGender_Status
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
    public function delete(int $Id_TypeGender) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeGenderModel::query();

			$oQuery->where("Id_TypeGender", "=", $Id_TypeGender);
			$oQuery->update([
				"TypeGender_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeGender_Name)"),
				"TypeGender_Status"	=> 0
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
    public function index(int $Id_TypeGender) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
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
			$oQuery	= TypeGenderModel::query();

			$oQuery->where("Id_TypeGender", "=", $Id_TypeGender);
			$oQuery->where("TypeGender_Status", "<>", "0");

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
    public function list(TypeGenderFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
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
                TypeGenderFilterDisplay::PUBLIC->value  => 2,
                TypeGenderFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeGenderModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeGender_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeGender_Status', '=', TypeGenderStatus::ACTIVE->value);
			$oQuery->orderBy("TypeGender_Name", "ASC");

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
    public function search(SearchTypeGenderDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeGenderModel::getEntity();
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
                TypeGenderFilterDisplay::PUBLIC->value  => 2,
                TypeGenderFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeGenderFilterStatus::ACTIVE->value   => 2,
                TypeGenderFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeGenderModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeGender_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeGender_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeGender_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	("TypeGender_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeGender_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeGender_Name", "ASC");
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