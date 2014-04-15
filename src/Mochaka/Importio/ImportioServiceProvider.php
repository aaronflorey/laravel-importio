<?php
namespace Mochaka\Importio;

use Illuminate\Support\ServiceProvider;
use Config;

class ImportioServiceProvider extends ServiceProvider {

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
		$this->package('mochaka/importio');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
    public function register()
    {
        $this->app['importio'] = $this->app->share(function($app)
        {
        	$userGuid = Config::get('importio::userGuid');
        	$apiKey = Config::get('importio::apiKey');
            return new Importio($userGuid, $apiKey);
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Importio', 'Mochaka\Importio\Facades\Importio');
        });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
