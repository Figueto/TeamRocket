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

//ROUTES FONCTIONS UTILISATEURS
//renvoient toutes un 200 OK avec RESTClient

//default route
$router->get('/', function () use ($router) {
    return $router->app->version();
});


$lienAPI = "api/";


/*________AUTH_________*/
$router->post($lienAPI.'login', 'AuthController@authenticate');
$router->get($lienAPI.'logout', 'AuthController@logout');




/*________PAYS_________*/
$router->get($lienAPI.'pays', 'PaysController@index');
$router->get($lienAPI.'pays/{country_code}', ['as'   => 'pays',	'uses' => 'PaysController@getPays']);
$router->post($lienAPI.'pays', 'PaysController@savePays');
$router->put($lienAPI.'pays/{country_code}', ['as'   => 'upd-pays',	'uses' => 'PaysController@updatePays']);
$router->delete($lienAPI.'pays/{country_code}', ['as'   => 'del-user',	'uses' => 'PaysController@deletePays']);



/*________USER_________*/

//liste des users
$router->get($lienAPI.'users', 'UtilisateurController@index');

//affiche user spécifique
$router->get($lienAPI.'user/{id}',  ['as'   => 'user',	'uses' => 'UtilisateurController@getUtilisateur']);

//ajouter user (rajoute un user dans la BDD, avec juste l'id pour l'instant)
$router->post($lienAPI.'user', 'UtilisateurController@saveUtilisateur');

//mettre à jour user
$router->put($lienAPI.'user/{id}', ['as'   => 'upd-user',	'uses' => 'UtilisateurController@updateUtilisateur']);

//supprimer user (suppr bien de la BDD)
$router->delete($lienAPI.'user/{id}', ['as'   => 'del-user',	'uses' => 'UtilisateurController@deleteUtilisateur']);
