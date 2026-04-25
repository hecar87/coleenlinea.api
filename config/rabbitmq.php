<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Rabbit MQ Configuration
	|--------------------------------------------------------------------------
	*/

	'host'		=> env('RABBITMQ_HOST', 'localhost'),
	'port'		=> env('RABBITMQ_PORT', '5667'),
	'user'		=> env('RABBITMQ_USER', 'rabbitmq'),
	'password'	=> env('RABBITMQ_PASSWORD', 'rabbitmq'),
	'vhost'		=> env('RABBITMQ_VHOST', '/'),

	/*
	|--------------------------------------------------------------------------
	| Emitter Queue configuration
	|--------------------------------------------------------------------------
	*/

	'emitter'	=> [
		'queue'		=> env('RABBITMQ_EMITTER_QUEUE', 'prueba.queue'),
		'exchange'	=> env('RABBITMQ_EMITTER_EXCHANGE', 'prueba.exchange'),
		'routing'	=> env('RABBITMQ_EMITTER_ROUTING', 'routing.prueba'),
	],

	/*
	|--------------------------------------------------------------------------
	| Consumer Queue configuration
	|--------------------------------------------------------------------------
	*/

	'consumer'	=> [
		'queue'		=> env('RABBITMQ_CONSUMER_QUEUE' , 'prueba.queue'),
		'exchange' 	=> env('RABBITMQ_CONSUMER_EXCHANGE', 'prueba.exchange'),
		'routing'	=> env('RABBITMQ_CONSUMER_ROUTING', 'routing.prueba')
	],

];
