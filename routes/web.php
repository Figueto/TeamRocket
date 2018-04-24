<?php

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
//default route
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$lienAPI = "api/";


/*________AUTH_________*/
$router->post($lienAPI.'login', 'AuthController@authenticate');




/*________PAYS_________*/

$router->get($lienAPI.'pays', 'PaysController@index');
$router->get($lienAPI.'pays/{country_code}', ['as'   => 'pays',	'uses' => 'PaysController@getPays']);
$router->post($lienAPI.'pays', 'PaysController@savePays');
$router->put($lienAPI.'pays/{country_code}', ['as'   => 'upd-pays',	'uses' => 'PaysController@updatePays']);
$router->delete($lienAPI.'pays/{country_code}', ['as'   => 'del-user',	'uses' => 'PaysController@deletePays']);

/*________USER_________*/

$router->get($lienAPI.'users', 'UtilisateurController@index');
$router->get($lienAPI.'user/{id}',  ['as'   => 'user',	'uses' => 'UtilisateurController@getUtilisateur']);
$router->post($lienAPI.'user', 'UtilisateurController@saveUtilisateur');
$router->put($lienAPI.'user/{id}', ['as'   => 'upd-user',	'uses' => 'UtilisateurController@updateUtilisateur']);
$router->delete($lienAPI.'user/{id}', ['as'   => 'del-user',	'uses' => 'UtilisateurController@deleteUtilisateur']);

 /*________CAST_________*/
$router->get($lienAPI.'casts', 'CastController@index');
$router->get($lienAPI.'cast/{id}',  [
    'as'   => 'cast',
    'uses' => 'CastController@getCast'
]);
$router->post($lienAPI.'cast', 'CastController@saveCast');
$router->put($lienAPI.'cast/{id}', [
     'as'   => 'upd-cast',
     'uses' => 'CastController@updateCast'
]);
$router->delete($lienAPI.'cast/{id}', [
     'as'   => 'del-cast',
     'uses' => 'CastController@deleteCast'
     ]);

/*________NIVEAUUTILISATEUR_________*/

$router->get($lienAPI.'niveaux', 'NiveauUtilisateurController@index');
$router->get($lienAPI.'niveau/{id}',  ['as'   => 'niveau',	'uses' => 'NiveauUtilisateurController@getNiveau']);
$router->post($lienAPI.'niveau', 'NiveauUtilisateurController@saveNiveau');
$router->put($lienAPI.'niveau/{id}', ['as'   => 'upd-niveau',	'uses' => 'NiveauUtilisateurController@updateNiveau']);
$router->delete($lienAPI.'niveau/{id}', ['as'   => 'del-niveau',	'uses' => 'NiveauUtilisateurController@deleteNiveau']);

/*________ENUMOPERATION_________*/

$router->get($lienAPI.'operations', 'EnumOperationController@index');
$router->get($lienAPI.'operation/{id}',  ['as'   => 'operation',	'uses' => 'EnumOperationController@getOperation']);
$router->post($lienAPI.'operation', 'EnumOperationController@saveOperation');
$router->put($lienAPI.'operation/{id}', ['as'   => 'upd-operation',	'uses' => 'EnumOperationController@updateOperation']);
$router->delete($lienAPI.'operation/{id}', ['as'   => 'del-operation',	'uses' => 'EnumOperationController@deleteOperation']);
