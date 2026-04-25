<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class MessageProcessor implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


	private $oMessage;


	public function __construct($Message)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$this->oMessage = $Message;

	}


	public function handle(): void
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$pDate		= $this->oMessage["date"];
		$pAction 	= $this->oMessage["action"];
		$pEntity 	= $this->oMessage["entity"];
		$pData 		= $this->oMessage["data"];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		echo ":: Message processed :: \n";

	}
}
