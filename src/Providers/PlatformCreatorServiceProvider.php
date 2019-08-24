<?php
namespace Kaankilic\PlatformCreator\Providers;
use Illuminate\Support\ServiceProvider;
use Kaankilic\PlatformCreator\Commands\ReadEnv;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Route;
class PlatformCreatorServiceProvider extends ServiceProvider {
	use DispatchesJobs;
	protected $defer = false;
	/**
	* Bootstrap the application services.
	*
	* @return void
	*/
	public function boot(\Illuminate\Routing\Router $router){



	}

	/**
	* Register the application services.
	*
	* @return void
	*/
	public function register(){
		if(app()->environment('staging','local', 'testing')){
			$this->loadViewsFrom(__DIR__.'/../../resources/views/','platform-creator');
			$this->loadRoutesFrom(__DIR__.'/../../resources/web.php');
		}
	}
}
