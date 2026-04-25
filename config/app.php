<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

	/*
	|--------------------------------------------------------------------------
	| Application Name
	|--------------------------------------------------------------------------
	*/

	'name' => env('APP_NAME', 'Laravel'),

	/*
	|--------------------------------------------------------------------------
	| Application Code
	|--------------------------------------------------------------------------
	*/

	"code"	=> env('APP_CODE', 'MSTR'),

	/*
	|--------------------------------------------------------------------------
	| Application Version
	|--------------------------------------------------------------------------
	*/

	"version"	=> env('APP_VERSION', '0.0.0.0'),

	/*
	|--------------------------------------------------------------------------
	| Application Environment
	|--------------------------------------------------------------------------
	*/

	'env' => env('APP_ENV', 'production'),

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	*/

	'debug' => (bool) env('APP_DEBUG', false),

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	*/

	'url' => env('APP_URL', 'http://localhost'),

	'asset_url' => env('ASSET_URL'),

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	*/

	'timezone' => 'UTC',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	*/

	'locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Application Fallback Locale
	|--------------------------------------------------------------------------
	*/

	'fallback_locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Faker Locale
	|--------------------------------------------------------------------------
	*/

	'faker_locale' => 'en_US',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	*/

	'key' => env('APP_KEY'),

	'cipher' => 'AES-256-CBC',

	/*
	|--------------------------------------------------------------------------
	| Maintenance Mode Driver
	|--------------------------------------------------------------------------
	*/

	'maintenance' => [
		'driver' => 'file',
		// 'store' => 'redis',
	],

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	*/

	'providers' => ServiceProvider::defaultProviders()->merge([
		/*
		* Package Service Providers...
		*/

		/*
		* Application Service Providers...
		*/
		App\Providers\AppServiceProvider::class,
		App\Providers\AuthServiceProvider::class,
		// App\Providers\BroadcastServiceProvider::class,
		App\Providers\EventServiceProvider::class,
		App\Providers\RouteServiceProvider::class,
	])->toArray(),

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	*/

	'aliases' => Facade::defaultAliases()->merge([
		//
		// Rabbit MQ
		//
		"Amqp" 		=> 'Bschmitt\Amqp\Facades\Amqp',

		//
		//	Helpers
		//
		"FunctionHelper"	=> App\Helpers\FunctionHelper::class,
		"MetadataManager"	=> App\Helpers\MetadataManager::class,
		"PaginationManager"	=> App\Helpers\PaginationManager::class,
		"ResponseManager"	=> App\Helpers\ResponseManager::class,
		"ResultManager"		=> App\helpers\ResultManager::class,
		"ValidateManager"	=> App\Helpers\ValidateManager::class,

	])->toArray(),

];
