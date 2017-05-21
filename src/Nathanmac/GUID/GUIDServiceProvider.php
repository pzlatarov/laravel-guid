<?php namespace Pzlatarov\GUID;

use Illuminate\Support\ServiceProvider;

class GUIDServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$laravel = app();
		if (version_compare($laravel::VERSION, '4.2', '<='))
		{
			$this->package('pzlatarov/guid');
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('GUID',function($app) {
		    return new GUID;
		});

		$this->app->booting(function() {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('GUID', 'Pzlatarov\GUID\Facades\GUID');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('guid');
	}

}
