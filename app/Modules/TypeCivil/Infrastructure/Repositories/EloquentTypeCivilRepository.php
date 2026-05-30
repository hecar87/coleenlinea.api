<?php
namespace App\Modules\TypeCivil\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeCivil\Domain\Repositories\ITypeCivilRepository;
use App\Modules\TypeCivil\Infrastructure\Persistence\EloquentTypeCivil as TypeCivilModel;

use App\Modules\TypeCivil\Application\DTOs\CreateTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\UpdateTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\DuplicatedTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\SearchTypeCivilDTO;

use App\Modules\TypeCivil\Domain\Enums\TypeCivilFilterDisplay;
use App\Modules\TypeCivil\Domain\Enums\TypeCivilFilterStatus;
use App\Modules\TypeCivil\Domain\Enums\TypeCivilPublic;
use App\Modules\TypeCivil\Domain\Enums\TypeCivilStatus;


class EloquentTypeCivilRepository implements ITypeCivilRepository
{
	public function getEntity(): string
	{
		return TypeCivilModel::getEntity();
	}

	public function exists(int $Id_TypeCivil) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
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
			$oQuery	= TypeCivilModel::query();

			$oQuery->where("Id_TypeCivil", "=", $Id_TypeCivil);
			$oQuery->where("TypeCivil_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeCivilDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
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
			$oQuery	= TypeCivilModel::query();

			$oQuery->where("Id_TypeCivil", "<>", $dto->Id_TypeCivil);
			$oQuery->where("TypeCivil_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeCivil_Name", "=", $dto->TypeCivil_Name );
				$oSubQuery->orWhere	( "TypeCivil_Abrv", "=", $dto->TypeCivil_Abrv );
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
    public function create(CreateTypeCivilDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
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
			$oQuery	= TypeCivilModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeCivil"		=> $dto->Id_TypeCivil,
				"TypeCivil_Name"	=> trim( mb_strtoupper( $dto->TypeCivil_Name, "utf-8" ) ),
				"TypeCivil_Abrv"	=> trim( mb_strtoupper( $dto->TypeCivil_Abrv, "utf-8" ) ),
				"TypeCivil_Public"	=> $dto->TypeCivil_Public,
				"TypeCivil_Status"	=> $dto->TypeCivil_Status
			]);

			$oQuery->where("Id_TypeCivil", "=", "$Id");
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
    public function update(UpdateTypeCivilDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
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
			$oQuery	= TypeCivilModel::query();

			$oQuery->where("Id_TypeCivil", "=", $dto->Id_TypeCivil);
			$oQuery->update([
				"TypeCivil_Name"	=> trim( mb_strtoupper( $dto->TypeCivil_Name, "utf-8" ) ),
				"TypeCivil_Abrv"	=> trim( mb_strtoupper( $dto->TypeCivil_Abrv, "utf-8" ) ),
				"TypeCivil_Public"	=> $dto->TypeCivil_Public,
				"TypeCivil_Status"	=> $dto->TypeCivil_Status
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
    public function delete(int $Id_TypeCivil) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeCivilModel::query();

			$oQuery->where("Id_TypeCivil", "=", $Id_TypeCivil);
			$oQuery->update([
				"TypeCivil_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeCivil_Name)"),
				"TypeCivil_Status"	=> 0
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
    public function index(int $Id_TypeCivil) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
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
			$oQuery	= TypeCivilModel::query();

			$oQuery->where("Id_TypeCivil", "=", $Id_TypeCivil);
			$oQuery->where("TypeCivil_Status", "<>", "0");

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
    public function list(TypeCivilFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
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
                TypeCivilFilterDisplay::PUBLIC->value  => 2,
                TypeCivilFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeCivilModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeCivil_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeCivil_Status', '=', TypeCivilStatus::ACTIVE->value);
			$oQuery->orderBy("TypeCivil_Name", "ASC");

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
    public function search(SearchTypeCivilDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCivilModel::getEntity();
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
                TypeCivilFilterDisplay::PUBLIC->value  => 2,
                TypeCivilFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeCivilFilterStatus::ACTIVE->value   => 2,
                TypeCivilFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeCivilModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeCivil_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeCivil_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeCivil_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	("TypeCivil_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeCivil_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeCivil_Name", "ASC");
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