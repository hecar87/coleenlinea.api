<?php

namespace App\Modules\Charge\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Charge\Domain\Repositories\IChargeRepository;
use App\Modules\Charge\Infrastructure\Persistence\EloquentCharge as ChargeModel;

use App\Modules\Charge\Application\DTOs\CreateChargeDTO;
use App\Modules\Charge\Application\DTOs\UpdateChargeDTO;
use App\Modules\Charge\Application\DTOs\DuplicatedChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeByGuardianDTO;
use App\Modules\Charge\Application\DTOs\PayChargeDTO;

use App\Modules\Charge\Domain\Enums\ChargeFilterDisplay;
use App\Modules\Charge\Domain\Enums\ChargeFilterStatus;
use App\Modules\Charge\Domain\Enums\ChargePublic;
use App\Modules\Charge\Domain\Enums\ChargeStatus;


class EloquentChargeRepository implements IChargeRepository
{
	public function getEntity(): string
	{
		return ChargeModel::getEntity();
	}

	public function exists(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->where("Charge_Status", "<>", "0");

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
	public function duplicated(DuplicatedChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "<>", $dto->Id_Charge);
			$oQuery->where("Charge_Status", "<>", "0");
			$oQuery->where("Charge_Code", "=", $dto->Charge_Code);

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
	public function canPay(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->where("Charge_Status", "=", "1");

			$oData = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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
	public function canNullify(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->where("Charge_Status", "<>", "9");

			$oData = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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
	public function create(CreateChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$pCharge_Code = $this->generateCode();

			$Id 	= $oQuery->insertGetId([
				"Id_Charge"					=> $dto->Id_Charge,
				"Charge_Date_Created"		=> date("Y-m-d H:i:s"),
				"Charge_Date_Expiry"		=> date("Y-m-d H:i:s"),
				"Charge_Date_Paid"			=> date("Y-m-d H:i:s"),
				"Charge_Date_Nullified"		=> date("Y-m-d H:i:s"),
				"Charge_Code"				=> $pCharge_Code,
				"Charge_Name"				=> trim(mb_strtoupper($dto->Charge_Name, "utf-8")),
				"Charge_LastName"			=> trim(mb_strtoupper($dto->Charge_LastName, "utf-8")),
				"Charge_Email"				=> trim($dto->Charge_Email),
				"Charge_NoDocument"			=> trim(mb_strtoupper($dto->Charge_NoDocument, "utf-8")),
				"Charge_Phone"				=> trim(mb_strtoupper($dto->Charge_Phone, "utf-8")),
				"Charge_Amount_Subtotal"	=> 0,
				"Charge_Amount_Tax"			=> 0,
				"Charge_Amount_Total"		=> 0,
				"Charge_Pay_Signature"		=> "",
				"Charge_Pay_Authorization"	=> "",
				"Charge_Pay_Message"		=> "",
				"Charge_Pay_Description"	=> "",
				"Charge_Pay_ECIDescription"	=> "",
				"Charge_Card_Last"			=> "",
				"Charge_Card_Number"		=> "",
				"Charge_Card_Brand"			=> "",
				"Charge_Card_Type"			=> "",
				"Charge_Card_Issuer"		=> "",
				"Charge_Response"			=> "",
				"Charge_Status"				=> 1,
				"Id_Guardian"				=> $dto->Id_Guardian,
				"Id_TypeCurrency"			=> $dto->Id_TypeCurrency,
				"Id_TypePayment"			=> $dto->Id_TypePayment
			]);

			$oQuery->where("Id_Charge", "=", "$Id");
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
	public function update(UpdateChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $dto->Id_Charge);
			$oQuery->update([
				"Charge_Name"				=> trim(mb_strtoupper($dto->Charge_Name, "utf-8")),
				"Charge_LastName"			=> trim(mb_strtoupper($dto->Charge_LastName, "utf-8")),
				"Charge_Email"				=> trim($dto->Charge_Email),
				"Charge_NoDocument"			=> trim(mb_strtoupper($dto->Charge_NoDocument, "utf-8")),
				"Charge_Phone"				=> trim(mb_strtoupper($dto->Charge_Phone, "utf-8")),
				"Id_Guardian"				=> $dto->Id_Guardian,
				"Id_TypeCurrency"			=> $dto->Id_TypeCurrency,
				"Id_TypePayment"			=> $dto->Id_TypePayment,
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
	public function delete(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->update([
				"Charge_Code"	=> DB::raw("CONCAT('( DELETED ) ', Charge_Code)"),
				"Charge_Status"	=> 0
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
	public function index(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_guardian", "t_charge.Id_Guardian", "=", "t_guardian.Id_Guardian");
			$oQuery->join("t_type_currency", "t_charge.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_payment", "t_charge.Id_TypePayment", "=", "t_type_payment.Id_TypePayment");
			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->where("Charge_Status", "<>", "0");

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
	public function find(int $Charge_Code): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_guardian", "t_charge.Id_Guardian", "=", "t_guardian.Id_Guardian");
			$oQuery->join("t_type_currency", "t_charge.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_payment", "t_charge.Id_TypePayment", "=", "t_type_payment.Id_TypePayment");
			$oQuery->where("Charge_Code", "=", $Charge_Code);
			$oQuery->where("Charge_Status", "<>", "0");

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
	public function listByGuardian(int $Id_Guardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_type_currency", "t_charge.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_payment", "t_charge.Id_TypePayment", "=", "t_type_payment.Id_TypePayment");
			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->where('Charge_Status', '=', ChargeStatus::ACTIVE->value);
			$oQuery->orderBy("Charge_Date_Created", "DESC");

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
	public function search(SearchChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
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

			$whereStatus	= [
				ChargeFilterStatus::ACTIVE->value   => 2,
				ChargeFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_guardian", "t_charge.Id_Guardian", "=", "t_guardian.Id_Guardian");
			$oQuery->join("t_type_currency", "t_charge.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_payment", "t_charge.Id_TypePayment", "=", "t_type_payment.Id_TypePayment");

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Charge_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Charge_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Charge_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_Name", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_LastName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_Email", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Charge_Date_Created", "DESC");
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
	public function searchByGuardian(int $Id_Guardian, SearchChargeByGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
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

			$whereStatus	= [
				ChargeFilterStatus::ACTIVE->value   => 2,
				ChargeFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_type_currency", "t_charge.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_payment", "t_charge.Id_TypePayment", "=", "t_type_payment.Id_TypePayment");
			$oQuery->where("Id_Guardian", "=", $Id_Guardian);

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Charge_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Charge_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Charge_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_Name", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_LastName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_Email", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Charge_Date_Created", "DESC");
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
	public function pay(PayChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $dto->Id_Charge);
			$oQuery->update([
				"Charge_Pay_Signature"		=> $dto->Charge_Pay_Signature,
				"Charge_Pay_Authorization"	=> $dto->Charge_Pay_Authorization,
				"Charge_Pay_Message"		=> $dto->Charge_Pay_Message,
				"Charge_Pay_Description"	=> $dto->Charge_Pay_Description,
				"Charge_Pay_ECIDescription"	=> $dto->Charge_Pay_ECIDescription,
				"Charge_Card_Last"			=> $dto->Charge_Card_Last,
				"Charge_Card_Number"		=> $dto->Charge_Card_Number,
				"Charge_Card_Brand"			=> $dto->Charge_Card_Brand,
				"Charge_Card_Type"			=> $dto->Charge_Card_Type,
				"Charge_Card_Issuer"		=> $dto->Charge_Card_Issuer,
				"Charge_Response"			=> $dto->Charge_Response
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
	public function nullify(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->update([
				"Charge_Date_Nullified"		=> date("Y-m-d H:i:s"),
				"Charge_Status"				=> 9
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


	private function generateCode(): string
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= "";


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//

			$oResult = Str::orderedUuid()->getHex()->toString();
		} catch (\Throwable $oException) {
			$oResult = "ERCODE";
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
