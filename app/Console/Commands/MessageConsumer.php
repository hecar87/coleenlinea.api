<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;
use Bschmitt\Amqp\Facades\Amqp;

use App\Jobs\MessageProcessor;


class MessageConsumer extends Command
{

	protected $signature 	= "message:consume";
	protected $description 	= "Initialize worker to listen and process RabbitMQ Queues.";


	public function handle()
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		Amqp::consume(
			config("rabbitmq.consumer.queue"),
			function($Message, $Resolver)
			{
				try
				{
					$Resolver->acknowledge($Message);
					$oMessage = json_decode($Message->body, true);

					Queue::pushOn("processor", new MessageProcessor($oMessage));

					echo ":: Message received :: \n";
				}
				catch(\Exception $oException)
				{
					echo ":: Error receiving messages - " . $oException->getMessage() . " ::";
				}
			}
		);


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------

	}
}
