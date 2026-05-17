<?php

namespace App\Modules\TypePopulation\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypePopulation\Domain\Repositories\ITypePopulationRepository;
use App\Modules\TypePopulation\Infrastructure\Persistence\EloquentTypePopulation as TypePopulationModel;

use App\Modules\TypePopulation\Application\DTOs\CreateTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\UpdateTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\DuplicatedTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\SearchTypePopulationDTO;

use App\Modules\TypePopulation\Domain\Enums\TypePopulationFilterDisplay;
use App\Modules\TypePopulation\Domain\Enums\TypePopulationFilterStatus;
use App\Modules\TypePopulation\Domain\Enums\TypePopulationPublic;
use App\Modules\TypePopulation\Domain\Enums\TypePopulationStatus;


class EloquentTypePopulationRepository implements ITypePopulationRepository
{
	public function getEntity(): string
	{
		return TypePopulationModel::getEntity();
	}

	public function exists(int $Id_TypePopulation) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
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
			$oQuery	= TypePopulationModel::query();

			$oQuery->where("Id_TypePopulation", "=", $Id_TypePopulation);
			$oQuery->where("TypePopulation_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypePopulationDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
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
			$oQuery	= TypePopulationModel::query();

			$oQuery->where("Id_TypePopulation", "<>", $dto->Id_TypePopulation);
			$oQuery->where("TypePopulation_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypePopulation_Name", "=", $dto->TypePopulation_Name );
				$oSubQuery->orWhere	( "TypePopulation_Abrv", "=", $dto->TypePopulation_Abrv );
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
    public function create(CreateTypePopulationDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
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
			$oQuery	= TypePopulationModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"TypePopulation_Name"	=> trim( mb_strtoupper( $dto->TypePopulation_Name, "utf-8" ) ),
				"TypePopulation_Abrv"	=> trim( mb_strtoupper( $dto->TypePopulation_Abrv, "utf-8" ) ),
				"TypePopulation_Public"	=> $dto->TypePopulation_Public,
				"TypePopulation_Status"	=> $dto->TypePopulation_Status
			]);

			$oQuery->where("Id_TypePopulation", "=", "$Id");
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
    public function update(UpdateTypePopulationDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
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
			$oQuery	= TypePopulationModel::query();

			$oQuery->where("Id_TypePopulation", "=", $dto->Id_TypePopulation);
			$oQuery->update([
				"TypePopulation_Name"	=> trim( mb_strtoupper( $dto->TypePopulation_Name, "utf-8" ) ),
				"TypePopulation_Abrv"	=> trim( mb_strtoupper( $dto->TypePopulation_Abrv, "utf-8" ) ),
				"TypePopulation_Public"	=> $dto->TypePopulation_Public,
				"TypePopulation_Status"	=> $dto->TypePopulation_Status
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
    public function delete(int $Id_TypePopulation) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypePopulationModel::query();

			$oQuery->where("Id_TypePopulation", "=", $Id_TypePopulation);
			$oQuery->update([
				"TypePopulation_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypePopulation_Name)"),
				"TypePopulation_Status"	=> 0
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
    public function index(int $Id_TypePopulation) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
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
			$oQuery	= TypePopulationModel::query();

			$oQuery->where("Id_TypePopulation", "=", $Id_TypePopulation);
			$oQuery->where("TypePopulation_Status", "<>", "0");

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
    public function list(TypePopulationFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
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
                TypePopulationFilterDisplay::PUBLIC->value  => 2,
                TypePopulationFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypePopulationModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypePopulation_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypePopulation_Status', '=', TypePopulationStatus::ACTIVE->value);
			$oQuery->orderBy("TypePopulation_Name", "ASC");

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
    public function search(SearchTypePopulationDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePopulationModel::getEntity();
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
                TypePopulationFilterDisplay::PUBLIC->value  => 2,
                TypePopulationFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypePopulationFilterStatus::ACTIVE->value   => 2,
                TypePopulationFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypePopulationModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypePopulation_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypePopulation_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypePopulation_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("TypePopulation_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypePopulation_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypePopulation_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypePopulation_Name", "ASC");
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