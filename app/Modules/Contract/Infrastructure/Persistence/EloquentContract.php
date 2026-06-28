<?php

namespace App\Modules\Contract\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentContract extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_contract";
	protected $entity		= "CONTRACT";
	protected $primaryKey 	= "Id_Contract";
	protected $fillable 	= [
		"Id_Contract",
		"Contract_Date_Created",
		"Contract_Date_Approved",
		"Contract_Date_Nullified",
		"Contract_Date_Closed",
		"Contract_Code",
		"Contract_Title",
		"Contract_Date_Start",
		"Contract_Date_End",
		"Contract_Manager_Name",
		"Contract_Manager_LastName",
		"Contract_Manager_Position",
		"Contract_Manager_Document",
		"Contract_Status",
		"Id_TypeDocument",
		"Id_School"
	];
	protected $hidden 		= [];
	protected $casts 		= [
		"Contract_Date_Created"		=> "datetime:c",
		"Contract_Date_Approved"	=> "datetime:c",
		"Contract_Date_Nullified"	=> "datetime:c",
		"Contract_Date_Closed"		=> "datetime:c"
	];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}