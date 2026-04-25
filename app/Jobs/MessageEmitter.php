<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Bschmitt\Amqp\Facades\Amqp;


class MessageEmitter implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


	private $pAction;
	private $pEntity;
	private $pData;


	public function __construct($Action, $Entity, $Data)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$this->pAction 	= $Action;
		$this->pEntity 	= $Entity;
		$this->pData 	= $Data;
	}


	public function handle(): void
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oMessage = [
			"date"		=> date("Y-m-d H:i:s"),
			"action"	=> $this->pAction,
			"entity"	=> $this->pEntity,
			"data"		=> $this->pData
		];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		Amqp::publish(
			config("rabbitmq.emitter.routing"),
			json_encode($oMessage),
			[
				"exchange" => config("rabbitmq.emitter.exchange"),
			]
		);


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		echo ":: Message send :: \n";

	}
}
