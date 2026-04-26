<?php
namespace App\Infrastructure\District\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Domain\District\Repositories\IDistrictRepository;
use App\Domain\District\Entities\District as DistrictEntity;
use App\Infrastructure\District\Persistence\EloquentDistrict as DistrictModel;

use App\Application\District\DTOs\CreateDistrictDTO;
use App\Application\District\DTOs\UpdateDistrictDTO;
use App\Application\District\DTOs\DuplicatedDistrictDTO;
use App\Application\District\DTOs\SearchDistrictDTO;

use App\Domain\District\Enums\DistrictFilterDisplay;
use App\Domain\District\Enums\DistrictFilterStatus;
use App\Domain\District\Enums\DistrictPublic;
use App\Domain\District\Enums\DistrictStatus;


class EloquentDistrictRepository implements IDistrictRepository
{
	public function getEntity(): string
	{
		return DistrictModel::getEntity();
	}

	public function exists(int $Id_District) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
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
			$oQuery	= DistrictModel::query();

			$oQuery->where("Id_District", "=", $Id_District);
			$oQuery->where("District_Status", "<>", "0");

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
    public function duplicated(DuplicatedDistrictDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
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
			$oQuery	= DistrictModel::query();

			$oQuery->where("Id_District", "<>", $dto->Id_District);
			$oQuery->where("District_Status", "<>", "0");
			$oQuery->where("Id_City", "=", $dto->Id_City);
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	( "District_Code", "=", $dto->District_Code );
				$oSubQuery->orWhere	( "District_Name", "=", $dto->District_Name );
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
    public function create(CreateDistrictDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
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
			$oQuery	= DistrictModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_District"		=> $dto->Id_District,
				"District_Code"		=> trim( mb_strtoupper( $dto->District_Code, "utf-8" ) ),
				"District_Name"		=> trim( mb_strtoupper( $dto->District_Name, "utf-8" ) ),
				"District_Public"	=> $dto->District_Public,
				"District_Status"	=> $dto->District_Status,
				"Id_City"			=> $dto->Id_City
			]);

			$oQuery->where("Id_District", "=", "$Id");
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
    public function update(UpdateDistrictDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
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
			$oQuery	= DistrictModel::query();

			$oQuery->where("Id_District", "=", $dto->Id_District);
			$oQuery->update([
				"District_Code"		=> trim( mb_strtoupper( $dto->District_Code, "utf-8" ) ),
				"District_Name"		=> trim( mb_strtoupper( $dto->District_Name, "utf-8" ) ),
				"District_Public"	=> $dto->District_Public,
				"District_Status"	=> $dto->District_Status,
				"Id_City"			=> $dto->Id_City
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
    public function delete(int $Id_District) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= DistrictModel::query();

			$oQuery->where("Id_District", "=", $Id_District);
			$oQuery->update([
				"District_Name"	=> DB::raw("CONCAT('( DELETED ) ', District_Name)"),
				"District_Status"	=> 0
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
    public function index(int $Id_District) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
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
			$oQuery	= DistrictModel::query();

			$oQuery->where("Id_District", "=", $Id_District);
			$oQuery->where("District_Status", "<>", "0");

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
    public function list(int $Id_City, DistrictFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
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
                DistrictFilterDisplay::PUBLIC->value  => 2,
                DistrictFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= DistrictModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('District_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('District_Status', '<>', DistrictStatus::ACTIVE->value);
			$oQuery->where("Id_City", "=", $Id_City);
			$oQuery->orderBy("District_Name", "ASC");

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
    public function search(int $Id_City, SearchDistrictDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= DistrictModel::getEntity();
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
                DistrictFilterDisplay::PUBLIC->value  => 2,
                DistrictFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                DistrictFilterStatus::ACTIVE->value   => 2,
                DistrictFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= DistrictModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('District_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('District_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('District_Status', '<>', 0);
            }

			$oQuery->where("Id_City", "=", $Id_City);
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("District_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("District_Name", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("District_Name", "ASC");
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