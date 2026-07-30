<?php

namespace App\Modules\Charge\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentCharge extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_charge";
	protected $entity		= "CHARGE";
	protected $primaryKey 	= "Id_Charge";
	protected $fillable 	= [
		"Id_Charge",
		"Charge_Date_Created",
		"Charge_Date_Expiry",
		"Charge_Date_Paid",
		"Charge_Date_Nullified",
		"Charge_Code",
		"Charge_Name",
		"Charge_LastName",
		"Charge_Email",
		"Charge_NoDocument",
		"Charge_Phone",
		"Charge_Amount_Subtotal",
		"Charge_Amount_Tax",
		"Charge_Amount_Total",
		"Charge_Pay_Signature",
		"Charge_Pay_Authorization",
		"Charge_Pay_Message",
		"Charge_Pay_Description",
		"Charge_Pay_ECIDescription",
		"Charge_Card_Last",
		"Charge_Card_Number",
		"Charge_Card_Brand",
		"Charge_Card_Type",
		"Charge_Card_Issuer",
		"Charge_Response",
		"Charge_Status",
		"Id_Guardian",
		"Id_TypeCurrency",
		"Id_TypePayment",
	];
	protected $hidden 		= [];
	protected $casts 		= [
		"Charge_Date_Created"	=> "datetime:c",
		"Charge_Date_Expiry"	=> "datetime:c",
		"Charge_Date_Paid"		=> "datetime:c",
		"Charge_Date_Nullified"	=> "datetime:c"
	];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}