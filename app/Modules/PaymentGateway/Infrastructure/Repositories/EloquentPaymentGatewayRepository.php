<?php

namespace App\Modules\PaymentGateway\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;
use App\Modules\PaymentGateway\Infrastructure\Persistence\EloquentPaymentGateway as PaymentGatewayModel;

use App\Modules\PaymentGateway\Application\DTOs\CreatePaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\UpdatePaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\DuplicatedPaymentGatewayDTO;
use App\Modules\PaymentGateway\Application\DTOs\SearchPaymentGatewayDTO;

use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayFilterDisplay;
use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayFilterStatus;
use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayPublic;
use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayStatus;


class EloquentPaymentGatewayRepository implements IPaymentGatewayRepository
{
	public function getEntity(): string
	{
		return PaymentGatewayModel::getEntity();
	}

	public function exists(int $Id_PaymentGateway): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= PaymentGatewayModel::query();

			$oQuery->where("Id_PaymentGateway", "=", $Id_PaymentGateway);
			$oQuery->where("PaymentGateway_Status", "<>", "0");

			$exists = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($exists == 1) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2200, $oEntity);
			}
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function duplicated(DuplicatedPaymentGatewayDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= PaymentGatewayModel::query();

			$oQuery->where("Id_PaymentGateway", "<>", $dto->Id_PaymentGateway);
			$oQuery->where("PaymentGateway_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("PaymentGateway_Code", "=", $dto->PaymentGateway_Code);
				$oSubQuery->orWhere("PaymentGateway_Name", "=", $dto->PaymentGateway_Name);
				$oSubQuery->orWhere("PaymentGateway_Abrv", "=", $dto->PaymentGateway_Abrv);
			});

			$Duplicate	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($Duplicate == 0) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function create(CreatePaymentGatewayDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= PaymentGatewayModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_PaymentGateway"		=> $dto->Id_PaymentGateway,
				"PaymentGateway_Code"	=> trim(mb_strtoupper($dto->PaymentGateway_Code, "utf-8")),
				"PaymentGateway_Name"	=> trim(mb_strtoupper($dto->PaymentGateway_Name, "utf-8")),
				"PaymentGateway_Abrv"	=> trim(mb_strtoupper($dto->PaymentGateway_Abrv, "utf-8")),
				"PaymentGateway_Public"	=> $dto->PaymentGateway_Public,
				"PaymentGateway_Status"	=> $dto->PaymentGateway_Status
			]);

			$oQuery->where("Id_PaymentGateway", "=", "$Id");
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1001, $oEntity, $oData);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function update(UpdatePaymentGatewayDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= PaymentGatewayModel::query();

			$oQuery->where("Id_PaymentGateway", "=", $dto->Id_PaymentGateway);
			$oQuery->update([
				"PaymentGateway_Code"	=> trim(mb_strtoupper($dto->PaymentGateway_Code, "utf-8")),
				"PaymentGateway_Name"	=> trim(mb_strtoupper($dto->PaymentGateway_Name, "utf-8")),
				"PaymentGateway_Abrv"	=> trim(mb_strtoupper($dto->PaymentGateway_Abrv, "utf-8")),
				"PaymentGateway_Public"	=> $dto->PaymentGateway_Public,
				"PaymentGateway_Status"	=> $dto->PaymentGateway_Status
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1002, $oEntity, $oData);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function delete(int $Id_PaymentGateway): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= PaymentGatewayModel::query();

			$oQuery->where("Id_PaymentGateway", "=", $Id_PaymentGateway);
			$oQuery->update([
				"PaymentGateway_Name"	=> DB::raw("CONCAT('( DELETED ) ', PaymentGateway_Name)"),
				"PaymentGateway_Status"	=> 0
			]);


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1003, $oEntity);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function index(int $Id_PaymentGateway): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= PaymentGatewayModel::query();

			$oQuery->where("Id_PaymentGateway", "=", $Id_PaymentGateway);
			$oQuery->where("PaymentGateway_Status", "<>", "0");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1004, $oEntity, $oData);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function list(PaymentGatewayFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	SET VARIABLES
			//
			$whereDisplay	= [
				PaymentGatewayFilterDisplay::PUBLIC->value  => 2,
				PaymentGatewayFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= PaymentGatewayModel::query();

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('PaymentGateway_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('PaymentGateway_Status', '=', PaymentGatewayStatus::ACTIVE->value);
			$oQuery->orderBy("PaymentGateway_Name", "ASC");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1005, $oEntity, $oData);
		}
		catch (\Throwable $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function search(SearchPaymentGatewayDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= PaymentGatewayModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	SET VARIABLES
			//
			$Page_Current	= $dto->Page_Current;
			$Page_Size		= PaginationManager::Pagination_Size($dto->Page_Size);
			$Page_Offset	= PaginationManager::Pagination_Offset($Page_Size, $Page_Current);

			$whereDisplay	= [
				PaymentGatewayFilterDisplay::PUBLIC->value  => 2,
				PaymentGatewayFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				PaymentGatewayFilterStatus::ACTIVE->value   => 2,
				PaymentGatewayFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= PaymentGatewayModel::query();

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('PaymentGateway_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('PaymentGateway_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('PaymentGateway_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("PaymentGateway_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("PaymentGateway_Name", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("PaymentGateway_Abrv", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("PaymentGateway_Name", "ASC");
			$oQuery->limit($Page_Size);
			$oQuery->offset($Page_Offset);

			// GET DATA
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1006, $oEntity, $oData, $Data_Total);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
