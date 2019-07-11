<?php
namespace Kaankilic\PlatformCreator\Http\Controller;
use App\Http\Controllers\Controller;
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
class InstallerController extends Controller
{
	use DispatchesJobs;
	public function index()
	{
		return view("platform-creator::welcome");
	}
	public function create(Request $request){
		$exitCode = Artisan::call('key:generate');
		$db = $request->only(["host","db_username","db_password","db_name"]);
		$app = $request->only(["app_name","app_url"]);
		$inputs = $request->only(["email","name","password"]);
		$purchase_code = $request->get("purchase_code");
		$client = new Client();
		$res = $client->request('GET', "http://verify.kaankilic.com/check/".$purchase_code);
		$validation = json_decode($res->getBody());
		if($res->getStatusCode()!="200"){
			throw new InvalidPurchaseCode("Conncetivity issue on the verification endpoint.");
		}
		if(!isset($validation->is)){
			throw new InvalidPurchaseCode("Verification response error.");
		}
		if($validation->is!="valid"){
			throw new InvalidPurchaseCode("Invalid Purchase Code");
		}
		$data = new Collection($this->dispatch(new ReadEnv()));
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
		event(new AppInstalledNotification($app, $purchase_code));
		return redirect()->route("login");
	}

	public function delete(Filesystem $files)
	{
		$json = file_get_contents(base_path('composer.json'));
		$pattern = '/,\s*("anomaly\/installer-module").*"/';
		$files->put(base_path('composer.json'), preg_replace($pattern, '', $json));
		$files->deleteDirectory(base_path('core/anomaly/installer-module'));
		return $this->redirect->back();
	}
}
