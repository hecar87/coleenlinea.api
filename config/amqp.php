<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Application Name
	|--------------------------------------------------------------------------
	*/

	'use' => 'production',

	'properties' => [

		'production' => [
			'host'                => env("RABBITMQ_HOST"),
			'port'                => env("RABBITMQ_PORT"),
			'username'            => env("RABBITMQ_USER"),
			'password'            => env("RABBITMQ_PASSWORD"),
			'vhost'               => env("RABBITMQ_VHOST"),
			'exchange'            => env("RABBITMQ_EMITTER_EXCHANGE"),
			'exchange_type'       => 'topic',
			'consumer_tag'        => 'common.queue',
			'ssl_options'         => [], // See https://secure.php.net/manual/en/context.ssl.php
			'connect_options'     => [], // See https://github.com/php-amqplib/php-amqplib/blob/master/PhpAmqpLib/Connection/AMQPSSLConnection.php
			'queue_properties'    => ['x-ha-policy' => ['S', 'all']],
			'exchange_properties' => [],
			'timeout'             => 0,


			'exchange_durable'      => true,


			'queue_durable'         => true,
		],

	],

];