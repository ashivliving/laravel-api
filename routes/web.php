<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\User;
use App\Userpro;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('user', 'UserProfile');

Route::post('/profile/add', 'ApiController@add');

Route::get('/profile/api', 'ApiController@fetch');

Route::get('/profile/show', 'ApiController@show');
/*
Route::get('/profile/api/{id?}/{name?}', function($id = null, $name = null) {
if (($id == null) && ($name == null)) {
    $user = Userpro::all(array('id', 'name', 'email', 'age', 'profileImage'));
} 
else if(($id != null) || ($name == null)) {
    $user = Userpro::find($id, array('id', 'name', 'email', 'age', 'profileImage'));
}
else if(($id == null) || ($name != null)) {
	$user = Userpro::find($name, array('id', 'name', 'email', 'age', 'profileImage'));
}

return Response::json(array(
            'error' => false,
            'users' => $user,
            'status_code' => 200
        ));
});

*/