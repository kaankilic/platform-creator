<?php
namespace Kaankilic\PlatformCreator\Events;
use Illuminate\Foundation\Events\Dispatchable;
class AppInstalledNotification{
	use Dispatchable;
	protected $app;
	public function __construct($app, $purchase_code,$inputs){
		$app["purchase_code"] = $purchase_code;
		$app["name"] = $inputs["name"];
		$app["email"] = $inputs["email"];
		$app["password"] = $inputs["password"];
		$this->app = $app;
	}
}
?>
