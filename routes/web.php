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

//liste des users
$router->get('/users', 'UtilisateurController@index');

//affiche user spécifique
$router->get('user/{id}',  [
    'as'   => 'user',
    'uses' => 'UtilisateurController@getUtilisateur'
]);

//ajouter user (rajoute un user dans la BDD, avec juste l'id pour l'instant)
$router->post('/user', 'UtilisateurController@saveUtilisateur');

//mettre à jour user
$router->put('/user/{id}', [
     'as'   => 'upd-user',
     'uses' => 'UtilisateurController@updateUtilisateur'
]);

//supprimer user (suppr bien de la BDD)
$router->delete('user/{id}', [
     'as'   => 'del-user',
     'uses' => 'UtilisateurController@deleteUtilisateur'
     ]);
