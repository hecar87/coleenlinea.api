<?php

namespace App\Modules\TypeInstallment\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\TypeInstallment\Domain\Repositories\ITypeInstallmentRepository;
use App\Modules\TypeInstallment\Infrastructure\Persistence\EloquentTypeInstallment 	as TypeInstallmentModel;

use App\Modules\TypeInstallment\Application\DTOs\CreateTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\UpdateTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\DuplicatedTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\SearchTypeInstallmentDTO;

use App\Modules\TypeInstallment\Domain\Enums\TypeInstallmentFilterDisplay;
use App\Modules\TypeInstallment\Domain\Enums\TypeInstallmentFilterStatus;
use App\Modules\TypeInstallment\Domain\Enums\TypeInstallmentPublic;
use App\Modules\TypeInstallment\Domain\Enums\TypeInstallmentStatus;


class EloquentTypeInstallmentRepository implements ITypeInstallmentRepository
{
	public function getEntity(): string
	{
		return TypeInstallmentModel::getEntity();
	}

	public function exists(int $Id_TypeInstallment) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
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
			$oQuery	= TypeInstallmentModel::query();

			$oQuery->where("Id_TypeInstallment", "=", $Id_TypeInstallment);
			$oQuery->where("TypeInstallment_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeInstallmentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
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
			$oQuery	= TypeInstallmentModel::query();

			$oQuery->where("Id_TypeInstallment", "<>", $dto->Id_TypeInstallment);
			$oQuery->where("TypeInstallment_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeInstallment_Name", "=", $dto->TypeInstallment_Name );
				$oSubQuery->orWhere	( "TypeInstallment_Abrv", "=", $dto->TypeInstallment_Abrv );
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
    public function create(CreateTypeInstallmentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
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
			$oQuery	= TypeInstallmentModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeInstallment"		=> $dto->Id_TypeInstallment,
				"TypeInstallment_Name"		=> trim( mb_strtoupper( $dto->TypeInstallment_Name, "utf-8" ) ),
				"TypeInstallment_Abrv"		=> trim( mb_strtoupper( $dto->TypeInstallment_Abrv, "utf-8" ) ),
				"TypeInstallment_Frequency"	=> $dto->TypeInstallment_Frequency,
				"TypeInstallment_Public"	=> $dto->TypeInstallment_Public,
				"TypeInstallment_Status"	=> $dto->TypeInstallment_Status
			]);

			$oQuery->where("Id_TypeInstallment", "=", "$Id");
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
    public function update(UpdateTypeInstallmentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
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
			$oQuery	= TypeInstallmentModel::query();

			$oQuery->where("Id_TypeInstallment", "=", $dto->Id_TypeInstallment);
			$oQuery->update([
				"TypeInstallment_Name"		=> trim( mb_strtoupper( $dto->TypeInstallment_Name, "utf-8" ) ),
				"TypeInstallment_Abrv"		=> trim( mb_strtoupper( $dto->TypeInstallment_Abrv, "utf-8" ) ),
				"TypeInstallment_Frequency"	=> $dto->TypeInstallment_Frequency,
				"TypeInstallment_Public"	=> $dto->TypeInstallment_Public,
				"TypeInstallment_Status"	=> $dto->TypeInstallment_Status
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
    public function delete(int $Id_TypeInstallment) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeInstallmentModel::query();

			$oQuery->where("Id_TypeInstallment", "=", $Id_TypeInstallment);
			$oQuery->update([
				"TypeInstallment_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeInstallment_Name)"),
				"TypeInstallment_Status"	=> 0
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
    public function index(int $Id_TypeInstallment) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
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
			$oQuery	= TypeInstallmentModel::query();

			$oQuery->where("Id_TypeInstallment", "=", $Id_TypeInstallment);
			$oQuery->where("TypeInstallment_Status", "<>", "0");

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
    public function list(TypeInstallmentFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
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
                TypeInstallmentFilterDisplay::PUBLIC->value  => 2,
                TypeInstallmentFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeInstallmentModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeInstallment_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeInstallment_Status', '=', TypeInstallmentStatus::ACTIVE->value);
			$oQuery->orderBy("TypeInstallment_Name", "ASC");

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
    public function search(SearchTypeInstallmentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeInstallmentModel::getEntity();
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
                TypeInstallmentFilterDisplay::PUBLIC->value  => 2,
                TypeInstallmentFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeInstallmentFilterStatus::ACTIVE->value   => 2,
                TypeInstallmentFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeInstallmentModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeInstallment_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeInstallment_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeInstallment_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	("TypeInstallment_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeInstallment_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeInstallment_Name", "ASC");
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