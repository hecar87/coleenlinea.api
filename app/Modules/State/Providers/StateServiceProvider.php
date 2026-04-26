<?php

namespace App\Modules\State\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\State\Domain\Repositories\IStateRepository;
use App\Modules\State\Infrastructure\Repositories\EloquentStateRepository;

class StateServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(IStateRepository::class, EloquentStateRepository::class);
	}

	public function boot(): void
	{
		// rutas, eventos, etc.
	}
}