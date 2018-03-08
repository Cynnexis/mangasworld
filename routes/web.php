<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Afficher le formulaire d'authentification
Route::get('/getLogin', 'UtilisateurController@getLogin');

// Réponse au clic sur le bouton Valider du formulaire formLogin
Route::post('/signIn', 'UtilisateurController@signIn');

// Déloguer l'utilisateur
Route::get('/signOut', 'UtilisateurController@signOut');

// Afficher la liste de tous les Mangas
Route::get('/listerMangas', 'MangaController@getMangas');

// Afficher la liste déroulante des genres
Route::get('/listerGenres', 'GenreController@getGenres');

// Lister tous les mangas d'un genre séletionné
Route::post('/listerMangasGenre', 'MangaController@getMangasGenre');

// Afficher un manga pour pouvoir le modifier
Route::get('/modifierManga/{id}', 'MangaController@updateManga');
