<?php

namespace App\Modules\State\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;


class EloquentState extends Model
{
	public $timestamps 		= false;
	protected $table 		= "t_state";
	protected $entity		= "STATE";
	protected $primaryKey 	= "Id_State";
	protected $fillable 	= [
		"Id_State",
		"State_Code",
		"State_Name",
		"State_Abrv",
		"State_Public",
		"State_Status"
	];
	protected $hidden 		= [];
	protected $casts 		= [];


	public static function getEntity()
	{
		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return with(new static)->entity;

	}
}