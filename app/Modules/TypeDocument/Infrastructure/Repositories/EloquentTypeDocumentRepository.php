<?php

namespace App\Modules\TypeDocument\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Domain\TypeDocument\Repositories\ITypeDocumentRepository;
use App\Domain\TypeDocument\Entities\TypeDocument as TypeDocumentEntity;
use App\Infrastructure\TypeDocument\Persistence\EloquentTypeDocument as TypeDocumentModel;

use App\Application\TypeDocument\DTOs\CreateTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\UpdateTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\DuplicatedTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\SearchTypeDocumentDTO;

use App\Domain\TypeDocument\Enums\TypeDocumentFilterDisplay;
use App\Domain\TypeDocument\Enums\TypeDocumentFilterStatus;
use App\Domain\TypeDocument\Enums\TypeDocumentPublic;
use App\Domain\TypeDocument\Enums\TypeDocumentStatus;


class EloquentTypeDocumentRepository implements ITypeDocumentRepository
{
	public function getEntity(): string
	{
		return TypeDocumentModel::getEntity();
	}

	public function exists(int $Id_TypeDocument) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
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
			$oQuery	= TypeDocumentModel::query();

			$oQuery->where("Id_TypeDocument", "=", $Id_TypeDocument);
			$oQuery->where("TypeDocument_Status", "<>", "0");

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
    public function duplicated(DuplicatedTypeDocumentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
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
			$oQuery	= TypeDocumentModel::query();

			$oQuery->where("Id_TypeDocument", "<>", $dto->Id_TypeDocument);
			$oQuery->where("TypeDocument_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->orWhere	( "TypeDocument_Name", "=", $dto->TypeDocument_Name );
				$oSubQuery->orWhere	( "TypeDocument_Abrv", "=", $dto->TypeDocument_Abrv );
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
    public function create(CreateTypeDocumentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
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
			$oQuery	= TypeDocumentModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"TypeDocument_Name"		=> trim( mb_strtoupper( $dto->TypeDocument_Name, "utf-8" ) ),
				"TypeDocument_Abrv"		=> trim( mb_strtoupper( $dto->TypeDocument_Abrv, "utf-8" ) ),
				"TypeDocument_Public"	=> $dto->TypeDocument_Public,
				"TypeDocument_Status"	=> $dto->TypeDocument_Status
			]);

			$oQuery->where("Id_TypeDocument", "=", "$Id");
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
    public function update(UpdateTypeDocumentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
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
			$oQuery	= TypeDocumentModel::query();

			$oQuery->where("Id_TypeDocument", "=", $dto->Id_TypeDocument);
			$oQuery->update([
				"TypeDocument_Name"		=> trim( mb_strtoupper( $dto->TypeDocument_Name, "utf-8" ) ),
				"TypeDocument_Abrv"		=> trim( mb_strtoupper( $dto->TypeDocument_Abrv, "utf-8" ) ),
				"TypeDocument_Public"	=> $dto->TypeDocument_Public,
				"TypeDocument_Status"	=> $dto->TypeDocument_Status
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
    public function delete(int $Id_TypeDocument) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			$oQuery	= TypeDocumentModel::query();

			$oQuery->where("Id_TypeDocument", "=", $Id_TypeDocument);
			$oQuery->update([
				"TypeDocument_Name"	=> DB::raw("CONCAT('( DELETED ) ', TypeDocument_Name)"),
				"TypeDocument_Status"	=> 0
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
    public function index(int $Id_TypeDocument) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
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
			$oQuery	= TypeDocumentModel::query();

			$oQuery->where("Id_TypeDocument", "=", $Id_TypeDocument);
			$oQuery->where("TypeDocument_Status", "<>", "0");

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
    public function list(TypeDocumentFilterDisplay $Display) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
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
                TypeDocumentFilterDisplay::PUBLIC->value  => 2,
                TypeDocumentFilterDisplay::PRIVATE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeDocumentModel::query();

            if (isset($whereDisplay[$Display->value])) {
                $oQuery->where('TypeDocument_Public', $whereDisplay[$Display->value]);
            }

            $oQuery->where('TypeDocument_Status', '=', TypeDocumentStatus::ACTIVE->value);
			$oQuery->orderBy("TypeDocument_Name", "ASC");

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
    public function search(SearchTypeDocumentDTO $dto) : Result
    {
        //------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= TypeDocumentModel::getEntity();
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
                TypeDocumentFilterDisplay::PUBLIC->value  => 2,
                TypeDocumentFilterDisplay::PRIVATE->value => 1
            ];
			$whereStatus	= [
                TypeDocumentFilterStatus::ACTIVE->value   => 2,
                TypeDocumentFilterStatus::INACTIVE->value => 1
            ];


			//
			//	TRANSACTION
			//
			$oQuery	= TypeDocumentModel::query();

            if (isset($whereDisplay[$dto->Display->value])) {
                $oQuery->where('TypeDocument_Public', $whereDisplay[$dto->Display->value]);
            }

            if (isset($whereStatus[$dto->Status->value])) {
                $oQuery->where('TypeDocument_Status', $whereStatus[$dto->Status->value]);
            } else {
                $oQuery->where('TypeDocument_Status', '<>', 0);
            }

			$oQuery->where(function ($oSubQuery) use ($dto)
			{
				$oSubQuery->where	("TypeDocument_Code", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeDocument_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeDocument_Abrv", "LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("TypeDocument_Name", "ASC");
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