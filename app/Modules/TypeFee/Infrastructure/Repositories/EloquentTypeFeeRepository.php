<?php

namespace App\Modules\TypeFee\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeFee\Domain\Repositories\ITypeFeeRepository;
use App\Modules\TypeFee\Infrastructure\Persistence\EloquentTypeFee as TypeFeeModel;

use App\Modules\TypeFee\Application\DTOs\CreateTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\UpdateTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\DuplicatedTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\SearchTypeFeeDTO;

use App\Modules\TypeFee\Domain\Enums\TypeFeeFilterDisplay;
use App\Modules\TypeFee\Domain\Enums\TypeFeeFilterStatus;
use App\Modules\TypeFee\Domain\Enums\TypeFeePublic;
use App\Modules\TypeFee\Domain\Enums\TypeFeeStatus;


class EloquentTypeFeeRepository implements ITypeFeeRepository
{
	public function getEntity(): string
	{
		return TypeFeeModel::getEntity();
	}

	public function exists(int $Id_TypeFee) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
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
			$oQuery	= TypeFeeModel::query();

			$oQuery->where("Id_TypeFee", "=", $Id_TypeFee);
			$oQuery->where("TypeFee_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeFeeDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
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
			$oQuery	= TypeFeeModel::query();

			$oQuery->where("Id_TypeFee", "<>", $dto->Id_TypeFee);
			$oQuery->where("TypeFee_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeFee_Name", "=", $dto->TypeFee_Name );
				$oSubQuery->orWhere	( "TypeFee_Abrv", "=", $dto->TypeFee_Abrv );
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
    public function create(CreateTypeFeeDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
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
			$oQuery	= TypeFeeModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeFee"		=> $dto->Id_TypeFee,
				"TypeFee_Name"		=> trim( mb_strtoupper( $dto->TypeFee_Name, "utf-8" ) ),
				"TypeFee_Abrv"		=> trim( mb_strtoupper( $dto->TypeFee_Abrv, "utf-8" ) ),
				"TypeFee_Public"	=> $dto->TypeFee_Public,
				"TypeFee_Status"	=> $dto->TypeFee_Status
			]);

			$oQuery->where("Id_TypeFee", "=", "$Id");
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
    public function update(UpdateTypeFeeDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
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
			$oQuery	= TypeFeeModel::query();

			$oQuery->where("Id_TypeFee", "=", $dto->Id_TypeFee);
			$oQuery->update([
				"TypeFee_Name"		=> trim( mb_strtoupper( $dto->TypeFee_Name, "utf-8" ) ),
				"TypeFee_Abrv"		=> trim( mb_strtoupper( $dto->TypeFee_Abrv, "utf-8" ) ),
				"TypeFee_Public"	=> $dto->TypeFee_Public,
				"TypeFee_Status"	=> $dto->TypeFee_Status
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
    public function delete(int $Id_TypeFee) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeFeeModel::query();

			$oQuery->where("Id_TypeFee", "=", $Id_TypeFee);
			$oQuery->update([
				"TypeFee_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeFee_Name)"),
				"TypeFee_Status"	=> 0
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
    public function index(int $Id_TypeFee) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
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
			$oQuery	= TypeFeeModel::query();

			$oQuery->where("Id_TypeFee", "=", $Id_TypeFee);
			$oQuery->where("TypeFee_Status", "<>", "0");

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
    public function list(TypeFeeFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
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
                TypeFeeFilterDisplay::PUBLIC->value  => 2,
                TypeFeeFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeFeeModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeFee_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeFee_Status', '=', TypeFeeStatus::ACTIVE->value);
			$oQuery->orderBy("TypeFee_Name", "ASC");

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
    public function search(SearchTypeFeeDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeFeeModel::getEntity();
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
                TypeFeeFilterDisplay::PUBLIC->value  => 2,
                TypeFeeFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeFeeFilterStatus::ACTIVE->value   => 2,
                TypeFeeFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeFeeModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeFee_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeFee_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeFee_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	("TypeFee_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeFee_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeFee_Name", "ASC");
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