<?php
namespace App\Infrastructure\City\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Domain\City\Repositories\ICityRepository;
use App\Domain\City\Entities\City as CityEntity;
use App\Infrastructure\City\Persistence\EloquentCity as CityModel;

use App\Application\City\DTOs\CreateCityDTO;
use App\Application\City\DTOs\UpdateCityDTO;
use App\Application\City\DTOs\DuplicatedCityDTO;
use App\Application\City\DTOs\SearchCityDTO;

use App\Domain\City\Enums\CityFilterDisplay;
use App\Domain\City\Enums\CityFilterStatus;
use App\Domain\City\Enums\CityPublic;
use App\Domain\City\Enums\CityStatus;


class EloquentCityRepository implements ICityRepository
{
	public function getEntity(): string
	{
		return CityModel::getEntity();
	}

	public function exists(int $Id_City) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
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
			$oQuery	= CityModel::query();

			$oQuery->where("Id_City", "=", $Id_City);
			$oQuery->where("City_Status", "<>", "0");

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
    public function duplicated(DuplicatedCityDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
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
			$oQuery	= CityModel::query();

			$oQuery->where("Id_City", "<>", $dto->Id_City);
			$oQuery->where("City_Status", "<>", "0");
			$oQuery->where("Id_State", "=", $dto->Id_State);
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	( "City_Code", "=", $dto->City_Code );
				$oSubQuery->orWhere	( "City_Name", "=", $dto->City_Name );
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
    public function create(CreateCityDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
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
			$oQuery	= CityModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_City"		=> $dto->Id_City,
				"City_Code"		=> trim( mb_strtoupper( $dto->City_Code, "utf-8" ) ),
				"City_Name"		=> trim( mb_strtoupper( $dto->City_Name, "utf-8" ) ),
				"City_Public"	=> $dto->City_Public,
				"City_Status"	=> $dto->City_Status,
				"Id_State"		=> $dto->Id_State
			]);

			$oQuery->where("Id_City", "=", "$Id");
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
    public function update(UpdateCityDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
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
			$oQuery	= CityModel::query();

			$oQuery->where("Id_City", "=", $dto->Id_City);
			$oQuery->update([
				"City_Code"		=> trim( mb_strtoupper( $dto->City_Code, "utf-8" ) ),
				"City_Name"		=> trim( mb_strtoupper( $dto->City_Name, "utf-8" ) ),
				"City_Public"	=> $dto->City_Public,
				"City_Status"	=> $dto->City_Status,
				"Id_State"		=> $dto->Id_State
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
    public function delete(int $Id_City) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= CityModel::query();

			$oQuery->where("Id_City", "=", $Id_City);
			$oQuery->update([
				"City_Name"	=> DB::raw("CONCAT('( DELETED ) ', City_Name)"),
				"City_Status"	=> 0
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
    public function index(int $Id_City) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
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
			$oQuery	= CityModel::query();

			$oQuery->where("Id_City", "=", $Id_City);
			$oQuery->where("City_Status", "<>", "0");

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
    public function list(int $Id_State, CityFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
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
                CityFilterDisplay::PUBLIC->value  => 2,
                CityFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= CityModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('City_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('City_Status', '=', CityStatus::ACTIVE->value);
			$oQuery->where("Id_State", "=", $Id_State);
			$oQuery->orderBy("City_Name", "ASC");

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
    public function search(int $Id_State, SearchCityDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= CityModel::getEntity();
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
                CityFilterDisplay::PUBLIC->value  => 2,
                CityFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                CityFilterStatus::ACTIVE->value   => 2,
                CityFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= CityModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('City_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('City_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('City_Status', '<>', 0);
            }

			$oQuery->where("Id_State", "=", $Id_State);
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("City_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("City_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("City_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("City_Name", "ASC");
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