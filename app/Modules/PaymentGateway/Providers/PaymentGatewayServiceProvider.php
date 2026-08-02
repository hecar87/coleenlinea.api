<?php

namespace App\Modules\PaymentGateway\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayType;
use App\Modules\PaymentGateway\Domain\Repositories\IPaymentGatewayRepository;

use App\Modules\PaymentGateway\Infrastructure\Repositories\NiubizPaymentGatewayRepository;
use App\Modules\PaymentGateway\Infrastructure\Repositories\CulqiPaymentGatewayRepository;


class PaymentGatewayServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(
            IPaymentGatewayRepository::class,
            function ($app)
            {
                $oType = config('paymentgateway.default');

                return match ($oType)
                {
                    PaymentGatewayType::NIUBIZ => $app->make(NiubizPaymentGatewayRepository::class),
                    PaymentGatewayType::CULQI => $app->make(CulqiPaymentGatewayRepository::class),
                };
            }
        );
	}

	public function boot(): void
	{
		$basePath	= __DIR__ . "/../Http/Routes/";

		if (!is_dir($basePath)) {
            return;
        }


		// Manager
        if (file_exists($basePath . "ManagerRoutes.php")) {
            Route::prefix("manager")->group($basePath . "/ManagerRoutes.php");
        }
	}
}