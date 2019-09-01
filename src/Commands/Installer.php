<?php

namespace App\Console\Commands\Core;

use Illuminate\Console\Command;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Kaankilic\PlatformCreator\Commands\ReadEnv;
use Kaankilic\PlatformCreator\Commands\WriteEnv;
use Kaankilic\PlatformCreator\Commands\ReloadEnv;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Kaankilic\PlatformCreator\Exceptions\InvalidPurchaseCode;
use Artisan;
use Kaankilic\PlatformCreator\Events\AppInstalledNotification;
use Kaankilic\PlatformCreator\Http\Requests\InstallRequest;
class Installer extends Command
{
	use DispatchesJobs;
	/**
	* The name and signature of the console command.
	*
	* @var string
	*/
	protected $signature = 'source:install';

	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Installation command of app';

	/**
	* Create a new command instance.
	*
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* Execute the console command.
	*
	* @return mixed
	*/
	public function handle(){
		Artisan::call('key:generate');
		do {
			$purchase_code = $this->ask('Please set purchase code:');
		}while($this->verification($purchase_code));
		$db["app_name"] = $this->ask('app name:');
		$db["app_url"] = $this->ask('app url:');

		do{}
			$db["host"] = $this->ask('db host:');
			$db["db_username"] = $this->ask('db username:');
			$db["db_password"] = $this->ask('db password:');
			$db["db_name"] = $this->ask('db name:');
		}while($this->checkDB($db));
		$inputs["email"] = $this->ask("email");
		$inputs["name"] = $this->ask("name");
		$inputs["password"] = $this->ask("password");
		$data = new Collection($this->dispatch(new ReadEnv()));
		$old = $data->all();
		$data->put('DB_CONNECTION', "mysql");
		$data->put('DB_HOST', $db["host"]);
		$data->put('DB_DATABASE', $db['db_name']);
		$data->put('DB_USERNAME', $db['db_username']);
		$data->put('DB_PASSWORD', $db['db_password']);
		$data->put('APP_NAME', $app['app_name']);
		$data->put('APP_DEBUG', "false");
		$data->put('APP_ENV', "production");
		$data->put('APP_URL', $app['app_url']);
		$data->put('PURCHASE_CODE', $purchase_code);
		$this->dispatch(new WriteEnv($data->all()));
		$this->dispatch(new ReloadEnv());
		$exitCode = Artisan::call('migrate:fresh', [
			'--seed' => true
		]);
		Artisan::call('optimize:clear');
		event(new AppInstalledNotification($app, $purchase_code,$inputs));
	}
	public function checkDB($db){
		try{
			config([
				'database.connections.mysql.host' => $db["host"],
				'database.connections.mysql.database' => $db["db_name"],
				'database.connections.mysql.username' => $db["db_username"],
				'database.connections.mysql.password' => $db["db_password"]
			]);
			\DB::purge();
			\DB::connection()->getPdo();
			return true;
		}catch(\Exception $e){
			\Log::error($db["db_username"]." user with ".$db["db_name"]." (password:".$db["db_password"].") not connected to db.");
			return false;
		}
	}
	public function verification($purchase_code){
		$client = new Client();
		$res = $client->request('GET', "http://verify.kaankilic.com/check/".$purchase_code);
		$validation = json_decode($res->getBody());
		\Log::info($request->all());
		if($res->getStatusCode()!="200"){
			\Log::error("verification connectivity issue.");
			$this->danger("Could not connect to license manager.");
			return false;
		}
		if(!isset($validation->is)){
			\Log::error("verification response error.");
			$this->danger("You've typed invalid license");
			return false;
		}
		if($validation->is!="valid"){
			\Log::error("invalid license error");
			$this->info("Purchase code verified succesfully.");
			return true;
		}
	}
}