<?php

namespace App\Modules\TypeReceipt\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeReceipt\Domain\Repositories\ITypeReceiptRepository;
use App\Modules\TypeReceipt\Infrastructure\Persistence\EloquentTypeReceipt as TypeReceiptModel;

use App\Modules\TypeReceipt\Application\DTOs\CreateTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\UpdateTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\DuplicatedTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\SearchTypeReceiptDTO;

use App\modules\TypeReceipt\Domain\Enums\TypeReceiptFilterDisplay;
use App\modules\TypeReceipt\Domain\Enums\TypeReceiptFilterStatus;
use App\modules\TypeReceipt\Domain\Enums\TypeReceiptPublic;
use App\modules\TypeReceipt\Domain\Enums\TypeReceiptStatus;


class EloquentTypeReceiptRepository implements ITypeReceiptRepository
{
	public function getEntity(): string
	{
		return TypeReceiptModel::getEntity();
	}

	public function exists(int $Id_TypeReceipt) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
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
			$oQuery	= TypeReceiptModel::query();

			$oQuery->where("Id_TypeReceipt", "=", $Id_TypeReceipt);
			$oQuery->where("TypeReceipt_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeReceiptDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
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
			$oQuery	= TypeReceiptModel::query();

			$oQuery->where("Id_TypeReceipt", "<>", $dto->Id_TypeReceipt);
			$oQuery->where("TypeReceipt_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeReceipt_Name", "=", $dto->TypeReceipt_Name );
				$oSubQuery->orWhere	( "TypeReceipt_Abrv", "=", $dto->TypeReceipt_Abrv );
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
    public function create(CreateTypeReceiptDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
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
			$oQuery	= TypeReceiptModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeReceipt"		=> $dto->Id_TypeReceipt,
				"TypeReceipt_Name"		=> trim( mb_strtoupper( $dto->TypeReceipt_Name, "utf-8" ) ),
				"TypeReceipt_Abrv"		=> trim( mb_strtoupper( $dto->TypeReceipt_Abrv, "utf-8" ) ),
				"TypeReceipt_Public"	=> $dto->TypeReceipt_Public,
				"TypeReceipt_Status"	=> $dto->TypeReceipt_Status
			]);

			$oQuery->where("Id_TypeReceipt", "=", "$Id");
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
    public function update(UpdateTypeReceiptDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
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
			$oQuery	= TypeReceiptModel::query();

			$oQuery->where("Id_TypeReceipt", "=", $dto->Id_TypeReceipt);
			$oQuery->update([
				"TypeReceipt_Name"		=> trim( mb_strtoupper( $dto->TypeReceipt_Name, "utf-8" ) ),
				"TypeReceipt_Abrv"		=> trim( mb_strtoupper( $dto->TypeReceipt_Abrv, "utf-8" ) ),
				"TypeReceipt_Public"	=> $dto->TypeReceipt_Public,
				"TypeReceipt_Status"	=> $dto->TypeReceipt_Status
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
    public function delete(int $Id_TypeReceipt) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeReceiptModel::query();

			$oQuery->where("Id_TypeReceipt", "=", $Id_TypeReceipt);
			$oQuery->update([
				"TypeReceipt_Name"		=> DB::raw("CONCAT('( DELETED ) ', TypeReceipt_Name)"),
				"TypeReceipt_Status"	=> 0
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
    public function index(int $Id_TypeReceipt) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
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
			$oQuery	= TypeReceiptModel::query();

			$oQuery->where("Id_TypeReceipt", "=", $Id_TypeReceipt);
			$oQuery->where("TypeReceipt_Status", "<>", "0");

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
    public function list(TypeReceiptFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
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
                TypeReceiptFilterDisplay::PUBLIC->value  => 2,
                TypeReceiptFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeReceiptModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeReceipt_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeReceipt_Status', '=', TypeReceiptStatus::ACTIVE->value);
			$oQuery->orderBy("TypeReceipt_Name", "ASC");

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
    public function search(SearchTypeReceiptDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeReceiptModel::getEntity();
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
                TypeReceiptFilterDisplay::PUBLIC->value  => 2,
                TypeReceiptFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeReceiptFilterStatus::ACTIVE->value   => 2,
                TypeReceiptFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeReceiptModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeReceipt_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeReceipt_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeReceipt_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	("TypeReceipt_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeReceipt_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeReceipt_Name", "ASC");
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