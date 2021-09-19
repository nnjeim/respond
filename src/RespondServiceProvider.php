<?php

namespace Nnjeim\Respond;

use Illuminate\Support\ServiceProvider;

use Nnjeim\Respond\RespondHelper;

class RespondServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Load translations
		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'respond');

		// Load the configurations
		$this->mergeConfigFrom(__DIR__ . '/../config/respond.php', 'respond');

		if ($this->app->runningInConsole()) {
			$this->publishes([
				__DIR__ . '/../config/respond.php' => config_path('respond.php'),
			]);
		}
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register the main class to use with the facade
		$this->app->singleton('respond', function () {

			return new RespondHelper();
		});
	}
}
