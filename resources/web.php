<?php
Route::group(['as'=>'installer::','prefix'=>'/install','namespace'=>'Kaankilic\PlatformCreator\Http\Controller','middleware'=>'web'],function(){
	Route::get('/','InstallerController@index')->name('index');
	Route::post('/','InstallerController@create')->name("create");
});
