<?php
namespace App\Infrastructure\TypeSchool\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Domain\TypeSchool\Repositories\ITypeSchoolRepository;
use App\Domain\TypeSchool\Entities\TypeSchool as TypeSchoolEntity;
use App\Infrastructure\TypeSchool\Persistence\EloquentTypeSchool as TypeSchoolModel;

use App\Application\TypeSchool\DTOs\CreateTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\UpdateTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\DuplicatedTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\SearchTypeSchoolDTO;

use App\Domain\TypeSchool\Enums\TypeSchoolFilterDisplay;
use App\Domain\TypeSchool\Enums\TypeSchoolFilterStatus;
use App\Domain\TypeSchool\Enums\TypeSchoolPublic;
use App\Domain\TypeSchool\Enums\TypeSchoolStatus;


class EloquentTypeSchoolRepository implements ITypeSchoolRepository
{
	public function getEntity(): string
	{
		return TypeSchoolModel::getEntity();
	}

	public function exists(int $Id_TypeSchool) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
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
			$oQuery	= TypeSchoolModel::query();

			$oQuery->where("Id_TypeSchool", "=", $Id_TypeSchool);
			$oQuery->where("TypeSchool_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeSchoolDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
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
			$oQuery	= TypeSchoolModel::query();

			$oQuery->where("Id_TypeSchool", "<>", $dto->Id_TypeSchool);
			$oQuery->where("TypeSchool_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeSchool_Name", "=", $dto->TypeSchool_Name );
				$oSubQuery->orWhere	( "TypeSchool_Abrv", "=", $dto->TypeSchool_Abrv );
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
    public function create(CreateTypeSchoolDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
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
			$oQuery	= TypeSchoolModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeSchool"		=> $dto->Id_TypeSchool,
				"TypeSchool_Name"	=> trim( mb_strtoupper( $dto->TypeSchool_Name, "utf-8" ) ),
				"TypeSchool_Abrv"	=> trim( mb_strtoupper( $dto->TypeSchool_Abrv, "utf-8" ) ),
				"TypeSchool_Public"	=> $dto->TypeSchool_Public,
				"TypeSchool_Status"	=> $dto->TypeSchool_Status
			]);

			$oQuery->where("Id_TypeSchool", "=", "$Id");
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
    public function update(UpdateTypeSchoolDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
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
			$oQuery	= TypeSchoolModel::query();

			$oQuery->where("Id_TypeSchool", "=", $dto->Id_TypeSchool);
			$oQuery->update([
				"TypeSchool_Name"	=> trim( mb_strtoupper( $dto->TypeSchool_Name, "utf-8" ) ),
				"TypeSchool_Abrv"	=> trim( mb_strtoupper( $dto->TypeSchool_Abrv, "utf-8" ) ),
				"TypeSchool_Public"	=> $dto->TypeSchool_Public,
				"TypeSchool_Status"	=> $dto->TypeSchool_Status
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
    public function delete(int $Id_TypeSchool) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeSchoolModel::query();

			$oQuery->where("Id_TypeSchool", "=", $Id_TypeSchool);
			$oQuery->update([
				"TypeSchool_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeSchool_Name)"),
				"TypeSchool_Status"	=> 0
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
    public function index(int $Id_TypeSchool) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
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
			$oQuery	= TypeSchoolModel::query();

			$oQuery->where("Id_TypeSchool", "=", $Id_TypeSchool);
			$oQuery->where("TypeSchool_Status", "<>", "0");

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
    public function list(TypeSchoolFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
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
                TypeSchoolFilterDisplay::PUBLIC->value  => 2,
                TypeSchoolFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeSchoolModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeSchool_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeSchool_Status', '=', TypeSchoolStatus::ACTIVE->value);
			$oQuery->orderBy("TypeSchool_Name", "ASC");

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
    public function search(SearchTypeSchoolDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeSchoolModel::getEntity();
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
                TypeSchoolFilterDisplay::PUBLIC->value  => 2,
                TypeSchoolFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeSchoolFilterStatus::ACTIVE->value   => 2,
                TypeSchoolFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeSchoolModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeSchool_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeSchool_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeSchool_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("TypeSchool_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeSchool_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeSchool_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeSchool_Name", "ASC");
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