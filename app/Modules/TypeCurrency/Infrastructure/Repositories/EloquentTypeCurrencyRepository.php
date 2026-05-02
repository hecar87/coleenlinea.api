<?php

namespace App\Modules\TypeCurrency\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeCurrency\Infrastructure\Persistence\EloquentTypeCurrency as TypeCurrencyModel;

use App\Modules\TypeCurrency\Application\DTOs\CreateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\UpdateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\DuplicatedTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\SearchTypeCurrencyDTO;

use App\Modules\TypeCurrency\Domain\Enums\TypeCurrencyFilterDisplay;
use App\Modules\TypeCurrency\Domain\Enums\TypeCurrencyFilterStatus;
use App\Modules\TypeCurrency\Domain\Enums\TypeCurrencyPublic;
use App\Modules\TypeCurrency\Domain\Enums\TypeCurrencyStatus;


class EloquentTypeCurrencyRepository implements ITypeCurrencyRepository
{
	public function getEntity(): string
	{
		return TypeCurrencyModel::getEntity();
	}

	public function exists(int $Id_TypeCurrency) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
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
			$oQuery	= TypeCurrencyModel::query();

			$oQuery->where("Id_TypeCurrency", "=", $Id_TypeCurrency);
			$oQuery->where("TypeCurrency_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeCurrencyDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
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
			$oQuery	= TypeCurrencyModel::query();

			$oQuery->where("Id_TypeCurrency", "<>", $dto->Id_TypeCurrency);
			$oQuery->where("TypeCurrency_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	( "TypeCurrency_Code", "=", $dto->TypeCurrency_Code );
				$oSubQuery->orWhere	( "TypeCurrency_Name", "=", $dto->TypeCurrency_Name );
				$oSubQuery->orWhere	( "TypeCurrency_Symbol", "=", $dto->TypeCurrency_Symbol );
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
    public function create(CreateTypeCurrencyDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
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
			$oQuery	= TypeCurrencyModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency,
				"TypeCurrency_Code"		=> trim( mb_strtoupper( $dto->TypeCurrency_Code, "utf-8" ) ),
				"TypeCurrency_Name"		=> trim( mb_strtoupper( $dto->TypeCurrency_Name, "utf-8" ) ),
				"TypeCurrency_Symbol"	=> trim( mb_strtoupper( $dto->TypeCurrency_Symbol, "utf-8" ) ),
				"TypeCurrency_Public"	=> $dto->TypeCurrency_Public,
				"TypeCurrency_Status"	=> $dto->TypeCurrency_Status
			]);

			$oQuery->where("Id_TypeCurrency", "=", "$Id");
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
    public function update(UpdateTypeCurrencyDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
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
			$oQuery	= TypeCurrencyModel::query();

			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);
			$oQuery->update([
				"TypeCurrency_Code"		=> trim( mb_strtoupper( $dto->TypeCurrency_Code, "utf-8" ) ),
				"TypeCurrency_Name"		=> trim( mb_strtoupper( $dto->TypeCurrency_Name, "utf-8" ) ),
				"TypeCurrency_Symbol"	=> trim( mb_strtoupper( $dto->TypeCurrency_Symbol, "utf-8" ) ),
				"TypeCurrency_Public"	=> $dto->TypeCurrency_Public,
				"TypeCurrency_Status"	=> $dto->TypeCurrency_Status
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
    public function delete(int $Id_TypeCurrency) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeCurrencyModel::query();

			$oQuery->where("Id_TypeCurrency", "=", $Id_TypeCurrency);
			$oQuery->update([
				"TypeCurrency_Name"		=> DB::raw("CONCAT('( DELETED ) ', TypeCurrency_Name)"),
				"TypeCurrency_Status"	=> 0
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
    public function index(int $Id_TypeCurrency) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
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
			$oQuery	= TypeCurrencyModel::query();

			$oQuery->where("Id_TypeCurrency", "=", $Id_TypeCurrency);
			$oQuery->where("TypeCurrency_Status", "<>", "0");

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
    public function list(TypeCurrencyFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
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
                TypeCurrencyFilterDisplay::PUBLIC->value  => 2,
                TypeCurrencyFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeCurrencyModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeCurrency_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeCurrency_Status', '=', TypeCurrencyStatus::ACTIVE->value);
			$oQuery->orderBy("TypeCurrency_Name", "ASC");

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
    public function search(SearchTypeCurrencyDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeCurrencyModel::getEntity();
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
                TypeCurrencyFilterDisplay::PUBLIC->value  => 2,
                TypeCurrencyFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeCurrencyFilterStatus::ACTIVE->value   => 2,
                TypeCurrencyFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeCurrencyModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeCurrency_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeCurrency_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeCurrency_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("TypeCurrency_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeCurrency_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeCurrency_Symbol", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeCurrency_Name", "ASC");
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