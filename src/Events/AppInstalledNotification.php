<?php
namespace Kaankilic\PlatformCreator\Events;
use Illuminate\Foundation\Events\Dispatchable;
class AppInstalledNotification{
	use Dispatchable;
	protected $app;
	public function __construct($app, $purchase_code){
		$app["purchase_code"] = $purchase_code;
		$this->app = $app;
	}
}
?>
