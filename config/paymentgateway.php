<?php

use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayType;


return [

    /*
    |--------------------------------------------------------------------------
    | Default Payment Gateway
    |--------------------------------------------------------------------------
    */

    'default' => PaymentGatewayType::from(
        env('PAYMENT_GATEWAY', PaymentGatewayType::NIUBIZ->value)
    ),

	/*
	|--------------------------------------------------------------------------
	| Niubiz Configurations
	|--------------------------------------------------------------------------
	*/

	'niubiz' => [
        'environment' => env('NIUBIZ_ENVIRONMENT', 'sandbox'),
        'merchant_id' => env('NIUBIZ_MERCHANT_ID'),
        'username' => env('NIUBIZ_USERNAME'),
        'password' => env('NIUBIZ_PASSWORD'),
    ],

	/*
	|--------------------------------------------------------------------------
	| Culqi Configurations
	|--------------------------------------------------------------------------
	*/

	'culqi' => [
        'environment' => env('CULQI_ENVIRONMENT', 'sandbox'),
        'public_key' => env('CULQI_PUBLIC_KEY'),
        'secret_key' => env('CULQI_SECRET_KEY'),
    ],

];