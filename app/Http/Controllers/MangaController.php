<?php

namespace App\Http\Controllers;

use App\modeles\Dessinateur;
use App\modeles\Genre;
use App\modeles\Manga;
use App\modeles\Scenariste;
use Request;
use Illuminate\Support\Facades\Session;

class MangaController extends Controller
{
    public function getMangas() {
    	$erreur = Session::get('erreur');
    	Session::forget('erreur');
    	
    	$manga = new Manga();
    	
    	$mangas = $manga->getMangas();
    	
    	return view('listeMangas', compact('mangas', 'erreur'));
    }
    
    /**
     * Afficher la liste des mangas selon un genre
     * @return Vue listerMangas
     */
    public function getMangasGenre() {
    	$erreur = "";
    	$id_genre = Request::input('cbGenre');
    	
    	if ($id_genre) {
    		$manga = new Manga();
    		
    		$mangas = $manga->getMangasGenre($id_genre);
    		
    		return view('listeMangas', compact('mangas', 'erreur'));
	    }
	    else {
    		$erreur = "Il faut sélectionner un genre !";
    		Session::put('erreur', $erreur);
    		return redirect('/listerGenres');
	    }
    }
    
    /**
     * Initialise toutes les listes déroulantes
     * Lit le manga à modifier
     * Initialise le formulaire en mode Modification
     * @param int $id Id du manga
     * @param string $erreur message d'erreur (paramètre optionnel)
     * @return Vue formManga
     */
    public function updateManga($id, $erreur = "") {
    	$leManga = new Manga();
    	$manga = $leManga->getManga($id);
    	$genre = new Genre();
    	$genres = $genre->getGenres();
    	$dessinateur = new Dessinateur();
    	$dessinateurs = $dessinateur->getDessinateurs();
    	$scenariste = new Scenariste();
    	$scenaristes = $scenariste->getScenaristes();
    	$titreVue = "Modification d'un Manga";
    	
    	// Affiche le formulaire
	    return view('formManga', compact('manga', 'genres', 'dessinateurs', 'scenaristes', 'titreVue', 'erreur'));
    }
}
