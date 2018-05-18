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

$router->get($lienAPI.'user', 'UtilisateurController@index');
$router->get($lienAPI.'user/{id}',  ['as'   => 'user',	'uses' => 'UtilisateurController@getUtilisateur']);
$router->post($lienAPI.'user', 'UtilisateurController@saveUtilisateur');
$router->put($lienAPI.'user/{id}', ['as'   => 'upd-user',	'uses' => 'UtilisateurController@updateUtilisateur']);
$router->delete($lienAPI.'user/{id}', ['as'   => 'del-user',	'uses' => 'UtilisateurController@deleteUtilisateur']);

 /*________CAST_________*/
$router->get($lienAPI.'cast', 'CastController@index');
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

// $router->get($lienAPI.'niveau', 'NiveauUtilisateurController@index');
// $router->get($lienAPI.'niveau/{id}',  ['as'   => 'niveau',	'uses' => 'NiveauUtilisateurController@getNiveau']);
// $router->post($lienAPI.'niveau', 'NiveauUtilisateurController@saveNiveau');
// $router->put($lienAPI.'niveau/{id}', ['as'   => 'upd-niveau',	'uses' => 'NiveauUtilisateurController@updateNiveau']);
// $router->delete($lienAPI.'niveau/{id}', ['as'   => 'del-niveau',	'uses' => 'NiveauUtilisateurController@deleteNiveau']);


/*________ENUMOPERATION_________*/

// $router->get($lienAPI.'operations', 'EnumOperationController@index');
// $router->get($lienAPI.'operation/{id}',  ['as'   => 'operation',	'uses' => 'EnumOperationController@getOperation']);
// $router->post($lienAPI.'operation', 'EnumOperationController@saveOperation');
// $router->put($lienAPI.'operation/{id}', ['as'   => 'upd-operation',	'uses' => 'EnumOperationController@updateOperation']);
// $router->delete($lienAPI.'operation/{id}', ['as'   => 'del-operation',	'uses' => 'EnumOperationController@deleteOperation']);

/*________LOG_________*/

$router->get($lienAPI.'log', 'LogController@index');
$router->get($lienAPI.'log/{id}',  ['as'   => 'log',	'uses' => 'LogController@getLog']);
// $router->post($lienAPI.'log', 'LogController@saveLog');
// $router->put($lienAPI.'log/{id}', ['as'   => 'upd-log',	'uses' => 'LogController@updateLog']);
// $router->delete($lienAPI.'log/{id}', ['as'   => 'del-log',	'uses' => 'LogController@deleteLog']);

/*________REGARDER_________*/
$router->get($lienAPI.'avis', 'RegarderController@index');
$router->get($lienAPI.'avis/{idOeuvre}',  ['as'   => 'avis',	'uses' => 'RegarderController@getAvis']);
$router->get($lienAPI.'historique', 'RegarderController@getHistorique');
$router->post($lienAPI.'avis', 'RegarderController@saveAvis');
$router->put($lienAPI.'avis/{idOeuvre}', ['as'   => 'upd-avis',	'uses' => 'RegarderController@updateAvis']);
$router->delete($lienAPI.'avis/{idOeuvre}', ['as'   => 'del-avis',	'uses' => 'RegarderController@deleteAvis']);

/*________OEUVRE_________*/
$router->get($lienAPI.'oeuvre', 'OeuvreController@index');
$router->get($lienAPI.'oeuvre/{id}',  ['as'   => 'oeuvre',	'uses' => 'OeuvreController@getOeuvre']);
$router->get($lienAPI.'oeuvre/byslug/{slug}',  ['as'   => 'oeuvre',	'uses' => 'OeuvreController@getOeuvreBySlug']);
$router->get($lienAPI.'recos', ['as'   => 'reco-oeuvre',	'uses' => 'OeuvreController@getRecommendations']);
$router->get($lienAPI.'search',  ['as'   => 'search',	'uses' => 'OeuvreController@recherche']);
$router->put($lienAPI.'oeuvre/{id}/genre', ['as'   => 'upd-oeuvre-G',	'uses' => 'OeuvreController@addGenre']);
$router->put($lienAPI.'oeuvre/{id}/pays', ['as'   => 'upd-oeuvre-P',	'uses' => 'OeuvreController@addPays']);
$router->put($lienAPI.'oeuvre/{id}/acteur', ['as'   => 'upd-oeuvre-A',	'uses' => 'OeuvreController@addActeur']);
$router->put($lienAPI.'oeuvre/{id}/real', ['as'   => 'upd-oeuvre-R',	'uses' => 'OeuvreController@addReal']);
$router->post($lienAPI.'oeuvre', 'OeuvreController@saveOeuvre');
$router->put($lienAPI.'oeuvre/{id}', ['as'   => 'upd-oeuvre',	'uses' => 'OeuvreController@updateOeuvre']);
$router->delete($lienAPI.'oeuvre/{id}', ['as'   => 'del-oeuvre',	'uses' => 'OeuvreController@deleteOeuvre']);


/*________SERIE_________*/
// $router->get($lienAPI.'serie', 'SerieController@index');
// $router->get($lienAPI.'serie/{id}',  ['as'   => 'serie',	'uses' => 'SerieController@getSerie']);
// $router->post($lienAPI.'serie', 'SerieController@saveSerie');
// $router->put($lienAPI.'serie/{id}', ['as'   => 'upd-serie',	'uses' => 'SerieController@updateSerie']);
// $router->delete($lienAPI.'serie/{id}', ['as'   => 'del-serie',	'uses' => 'SerieController@deleteSerie']);

/*________GENRE_________*/
// $router->get($lienAPI.'genre', 'GenreController@index');
// $router->get($lienAPI.'genre/{id}',  ['as'   => 'genre',	'uses' => 'GenreController@getGenre']);
// $router->post($lienAPI.'genre', 'GenreController@saveGenre');
// $router->put($lienAPI.'genre/{id}', ['as'   => 'upd-genre',	'uses' => 'GenreController@updateGenre']);
// $router->delete($lienAPI.'genre/{id}', ['as'   => 'del-genre',	'uses' => 'GenreController@deleteGenre']);
