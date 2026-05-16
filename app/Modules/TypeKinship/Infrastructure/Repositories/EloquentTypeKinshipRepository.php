<?php

namespace App\Modules\TypeKinship\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeKinship\Domain\Repositories\ITypeKinshipRepository;
use App\Modules\TypeKinship\Infrastructure\Persistence\EloquentTypeKinship as TypeKinshipModel;

use App\Modules\TypeKinship\Application\DTOs\CreateTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\UpdateTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\DuplicatedTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\SearchTypeKinshipDTO;

use App\Modules\TypeKinship\Domain\Enums\TypeKinshipFilterDisplay;
use App\Modules\TypeKinship\Domain\Enums\TypeKinshipFilterStatus;
use App\Modules\TypeKinship\Domain\Enums\TypeKinshipPublic;
use App\Modules\TypeKinship\Domain\Enums\TypeKinshipStatus;


class EloquentTypeKinshipRepository implements ITypeKinshipRepository
{
	public function getEntity(): string
	{
		return TypeKinshipModel::getEntity();
	}

	public function exists(int $Id_TypeKinship) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
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
			$oQuery	= TypeKinshipModel::query();

			$oQuery->where("Id_TypeKinship", "=", $Id_TypeKinship);
			$oQuery->where("TypeKinship_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeKinshipDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
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
			$oQuery	= TypeKinshipModel::query();

			$oQuery->where("Id_TypeKinship", "<>", $dto->Id_TypeKinship);
			$oQuery->where("TypeKinship_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeKinship_Name", "=", $dto->TypeKinship_Name );
				$oSubQuery->orWhere	( "TypeKinship_Abrv", "=", $dto->TypeKinship_Abrv );
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
    public function create(CreateTypeKinshipDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
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
			$oQuery	= TypeKinshipModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeKinship"		=> $dto->Id_TypeKinship,
				"TypeKinship_Name"		=> trim( mb_strtoupper( $dto->TypeKinship_Name, "utf-8" ) ),
				"TypeKinship_Abrv"		=> trim( mb_strtoupper( $dto->TypeKinship_Abrv, "utf-8" ) ),
				"TypeKinship_Public"	=> $dto->TypeKinship_Public,
				"TypeKinship_Status"	=> $dto->TypeKinship_Status
			]);

			$oQuery->where("Id_TypeKinship", "=", "$Id");
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
    public function update(UpdateTypeKinshipDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
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
			$oQuery	= TypeKinshipModel::query();

			$oQuery->where("Id_TypeKinship", "=", $dto->Id_TypeKinship);
			$oQuery->update([
				"TypeKinship_Name"		=> trim( mb_strtoupper( $dto->TypeKinship_Name, "utf-8" ) ),
				"TypeKinship_Abrv"		=> trim( mb_strtoupper( $dto->TypeKinship_Abrv, "utf-8" ) ),
				"TypeKinship_Public"	=> $dto->TypeKinship_Public,
				"TypeKinship_Status"	=> $dto->TypeKinship_Status
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
    public function delete(int $Id_TypeKinship) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeKinshipModel::query();

			$oQuery->where("Id_TypeKinship", "=", $Id_TypeKinship);
			$oQuery->update([
				"TypeKinship_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeKinship_Name)"),
				"TypeKinship_Status"	=> 0
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
    public function index(int $Id_TypeKinship) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
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
			$oQuery	= TypeKinshipModel::query();

			$oQuery->where("Id_TypeKinship", "=", $Id_TypeKinship);
			$oQuery->where("TypeKinship_Status", "<>", "0");

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
    public function list(TypeKinshipFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
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
                TypeKinshipFilterDisplay::PUBLIC->value  => 2,
                TypeKinshipFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeKinshipModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeKinship_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeKinship_Status', '=', TypeKinshipStatus::ACTIVE->value);
			$oQuery->orderBy("TypeKinship_Name", "ASC");

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
    public function search(SearchTypeKinshipDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeKinshipModel::getEntity();
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
                TypeKinshipFilterDisplay::PUBLIC->value  => 2,
                TypeKinshipFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeKinshipFilterStatus::ACTIVE->value   => 2,
                TypeKinshipFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeKinshipModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeKinship_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeKinship_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeKinship_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("TypeKinship_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeKinship_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeKinship_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeKinship_Name", "ASC");
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