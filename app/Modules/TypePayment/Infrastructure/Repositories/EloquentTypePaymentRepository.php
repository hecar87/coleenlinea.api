<?php
namespace App\Infrastructure\TypePayment\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Domain\TypePayment\Repositories\ITypePaymentRepository;
use App\Domain\TypePayment\Entities\TypePayment as TypePaymentEntity;
use App\Infrastructure\TypePayment\Persistence\EloquentTypePayment as TypePaymentModel;

use App\Application\TypePayment\DTOs\CreateTypePaymentDTO;
use App\Application\TypePayment\DTOs\UpdateTypePaymentDTO;
use App\Application\TypePayment\DTOs\DuplicatedTypePaymentDTO;
use App\Application\TypePayment\DTOs\SearchTypePaymentDTO;

use App\Domain\TypePayment\Enums\TypePaymentFilterDisplay;
use App\Domain\TypePayment\Enums\TypePaymentFilterStatus;
use App\Domain\TypePayment\Enums\TypePaymentPublic;
use App\Domain\TypePayment\Enums\TypePaymentStatus;


class EloquentTypePaymentRepository implements ITypePaymentRepository
{
	public function getEntity(): string
	{
		return TypePaymentModel::getEntity();
	}

	public function exists(int $Id_TypePayment) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
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
			$oQuery	= TypePaymentModel::query();

			$oQuery->where("Id_TypePayment", "=", $Id_TypePayment);
			$oQuery->where("TypePayment_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypePaymentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
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
			$oQuery	= TypePaymentModel::query();

			$oQuery->where("Id_TypePayment", "<>", $dto->Id_TypePayment);
			$oQuery->where("TypePayment_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypePayment_Name", "=", $dto->TypePayment_Name );
				$oSubQuery->orWhere	( "TypePayment_Abrv", "=", $dto->TypePayment_Abrv );
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
    public function create(CreateTypePaymentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
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
			$oQuery	= TypePaymentModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypePayment"		=> $dto->Id_TypePayment,
				"TypePayment_Name"		=> trim( mb_strtoupper( $dto->TypePayment_Name, "utf-8" ) ),
				"TypePayment_Abrv"		=> trim( mb_strtoupper( $dto->TypePayment_Abrv, "utf-8" ) ),
				"TypePayment_Public"	=> $dto->TypePayment_Public,
				"TypePayment_Status"	=> $dto->TypePayment_Status
			]);

			$oQuery->where("Id_TypePayment", "=", "$Id");
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
    public function update(UpdateTypePaymentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
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
			$oQuery	= TypePaymentModel::query();

			$oQuery->where("Id_TypePayment", "=", $dto->Id_TypePayment);
			$oQuery->update([
				"TypePayment_Name"		=> trim( mb_strtoupper( $dto->TypePayment_Name, "utf-8" ) ),
				"TypePayment_Abrv"		=> trim( mb_strtoupper( $dto->TypePayment_Abrv, "utf-8" ) ),
				"TypePayment_Public"	=> $dto->TypePayment_Public,
				"TypePayment_Status"	=> $dto->TypePayment_Status
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
    public function delete(int $Id_TypePayment) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypePaymentModel::query();

			$oQuery->where("Id_TypePayment", "=", $Id_TypePayment);
			$oQuery->update([
				"TypePayment_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypePayment_Name)"),
				"TypePayment_Status"	=> 0
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
    public function index(int $Id_TypePayment) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
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
			$oQuery	= TypePaymentModel::query();

			$oQuery->where("Id_TypePayment", "=", $Id_TypePayment);
			$oQuery->where("TypePayment_Status", "<>", "0");

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
    public function list(TypePaymentFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
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
                TypePaymentFilterDisplay::PUBLIC->value  => 2,
                TypePaymentFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypePaymentModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypePayment_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypePayment_Status', '=', TypePaymentStatus::ACTIVE->value);
			$oQuery->orderBy("TypePayment_Name", "ASC");

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
    public function search(SearchTypePaymentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypePaymentModel::getEntity();
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
                TypePaymentFilterDisplay::PUBLIC->value  => 2,
                TypePaymentFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypePaymentFilterStatus::ACTIVE->value   => 2,
                TypePaymentFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypePaymentModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypePayment_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypePayment_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypePayment_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("TypePayment_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypePayment_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypePayment_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypePayment_Name", "ASC");
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