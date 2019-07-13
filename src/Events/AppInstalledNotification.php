<?php
namespace Kaankilic\PlatformCreator\Events;
use Illuminate\Foundation\Events\Dispatchable;
class AppInstalledNotification{
	use Dispatchable;
	public $app;
	public $purchase_code;
	public $user
	public function __construct($app, $purchase_code,$inputs){
		$this->app = $app;
		$this->purchase_code = $purchase_code;
		$this->user = $inputs;
	}
}
?>
