<?php
namespace Kaankilic\PlatformCreator\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class InstallRequest extends FormRequest{

	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize()
	{
		return true;
	}

	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules()
	{
		return [
			"host" => "required",
			"db_username" => "required",
			"db_password" => "nullable",
			"db_name" => "required",
			"app_name" => "required",
			"app_url" => "required",
			"email" => "required",
			"name" => "required",
			"password" => "required",
			"purchase_code" => "required"
		];
	}
}
?>
