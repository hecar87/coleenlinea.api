<?php
namespace App\Modules\TypeBank\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeBank\Domain\Repositories\ITypeBankRepository;
use App\Domain\TypeBank\Entities\TypeBank as TypeBankEntity;
use App\Modules\TypeBank\Infrastructure\Persistence\EloquentTypeBank as TypeBankModel;

use App\Modules\TypeBank\Application\DTOs\CreateTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\UpdateTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\DuplicatedTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\SearchTypeBankDTO;

use App\Modules\TypeBank\Domain\Enums\TypeBankFilterDisplay;
use App\Modules\TypeBank\Domain\Enums\TypeBankFilterStatus;
use App\Modules\TypeBank\Domain\Enums\TypeBankPublic;
use App\Modules\TypeBank\Domain\Enums\TypeBankStatus;


class EloquentTypeBankRepository implements ITypeBankRepository
{
	public function getEntity(): string
	{
		return TypeBankModel::getEntity();
	}

	public function exists(int $Id_TypeBank) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
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
			$oQuery	= TypeBankModel::query();

			$oQuery->where("Id_TypeBank", "=", $Id_TypeBank);
			$oQuery->where("TypeBank_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeBankDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
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
			$oQuery	= TypeBankModel::query();

			$oQuery->where("Id_TypeBank", "<>", $dto->Id_TypeBank);
			$oQuery->where("TypeBank_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	( "TypeBank_Code", "=", $dto->TypeBank_Code );
				$oSubQuery->orWhere	( "TypeBank_Name", "=", $dto->TypeBank_Name );
				$oSubQuery->orWhere	( "TypeBank_Abrv", "=", $dto->TypeBank_Abrv );
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
    public function create(CreateTypeBankDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
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
			$oQuery	= TypeBankModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeBank"		=> $dto->Id_TypeBank,
				"TypeBank_Code"		=> trim( mb_strtoupper( $dto->TypeBank_Code, "utf-8" ) ),
				"TypeBank_Name"		=> trim( mb_strtoupper( $dto->TypeBank_Name, "utf-8" ) ),
				"TypeBank_Abrv"		=> trim( mb_strtoupper( $dto->TypeBank_Abrv, "utf-8" ) ),
				"TypeBank_Public"	=> $dto->TypeBank_Public,
				"TypeBank_Status"	=> $dto->TypeBank_Status
			]);

			$oQuery->where("Id_TypeBank", "=", "$Id");
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
    public function update(UpdateTypeBankDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
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
			$oQuery	= TypeBankModel::query();

			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->update([
				"TypeBank_Code"		=> trim( mb_strtoupper( $dto->TypeBank_Code, "utf-8" ) ),
				"TypeBank_Name"		=> trim( mb_strtoupper( $dto->TypeBank_Name, "utf-8" ) ),
				"TypeBank_Abrv"		=> trim( mb_strtoupper( $dto->TypeBank_Abrv, "utf-8" ) ),
				"TypeBank_Public"	=> $dto->TypeBank_Public,
				"TypeBank_Status"	=> $dto->TypeBank_Status
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
    public function delete(int $Id_TypeBank) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeBankModel::query();

			$oQuery->where("Id_TypeBank", "=", $Id_TypeBank);
			$oQuery->update([
				"TypeBank_Name"		=> DB::raw("CONCAT('( DELETED ) ', TypeBank_Name)"),
				"TypeBank_Status"	=> 0
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
    public function index(int $Id_TypeBank) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
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
			$oQuery	= TypeBankModel::query();

			$oQuery->where("Id_TypeBank", "=", $Id_TypeBank);
			$oQuery->where("TypeBank_Status", "<>", "0");

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
    public function list(TypeBankFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
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
                TypeBankFilterDisplay::PUBLIC->value  => 2,
                TypeBankFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeBankModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeBank_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeBank_Status', '=', TypeBankStatus::ACTIVE->value);
			$oQuery->orderBy("TypeBank_Name", "ASC");

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
    public function search(SearchTypeBankDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeBankModel::getEntity();
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
                TypeBankFilterDisplay::PUBLIC->value  => 2,
                TypeBankFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeBankFilterStatus::ACTIVE->value   => 2,
                TypeBankFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeBankModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeBank_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeBank_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeBank_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("TypeBank_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeBank_Name", "ASC");
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