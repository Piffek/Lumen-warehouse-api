<?php
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


//region Product
$router->get('/getProducts', 'ProductController@getProducts');

$router->post('/addProduct', 'ProductController@addProduct');

$router->delete('/removeProduct', 'ProductController@removeProduct');

$router->put('/updateProduct', 'ProductController@updateProduct');
//endregion

//region Category

$router->get('/getCategories', 'CategoryController@getCategories');

$router->post('/addCategory', 'CategoryController@addCategory');

$router->delete('/removeCategory', 'CategoryController@removeCategory');

//endregion
$router->post('/auth', 'UserController@auth');

$router->group(['middleware' => 'jwt-auth'], function($router)
{

    $router->get('/users', 'UserController@all');
});

$router->post('/register', 'UserController@register');

$router->get('warehouse/user/{id}', 'UserController@warehouseForUser');

$router->post('user/warehouse/add/', 'UserController@addUserToWarehouse');

$router->post('/all/user', 'UserController@allUsers');

//pobranie uzytkowników

