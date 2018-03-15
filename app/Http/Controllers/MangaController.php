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
	
	public function addManga($erreur = "") {
		$manga = new Manga();
		$genre = new Genre();
		$genres = $genre->getGenres();
		$dessinateur = new Dessinateur();
		$dessinateurs = $dessinateur->getDessinateurs();
		$scenariste = new Scenariste();
		$scenaristes = $scenariste->getScenaristes();
		$titreVue = "Ajout d'un Manga";
		
		return view('formManga', compact('manga', 'genres', 'dessinateurs', "scenaristes", "titreVue", "erreur"));
	}
	
	/**
	 * Enregistre une mise à jour d'un manga
	 * Si la modification d'un Manga
	 * provoque une erreur fatale, on la place
	 * dans la Session et on réaffiche le formulaire
	 * Sinon réaffiche la liste des mangas
	 * @return Redirection listerMangas
	 * @throws Exception Thrown if cannot update manga
	 * @throws \Exception
	 */
	public function validateManga() {
		// TODO: Check if the $prix > 0
		
		$id_manga = Request::input('id_manga');
		$id_dessinateur = Request::input('cbDessinateur');
		$prix = Request::input('prix');
		$id_scenariste = Request::input('cbScenariste');
		$titre = Request::input('titre');
		$id_genre = Request::input('cbGenre');
		
		if (Request::hasFile('couverture')) {
			$image = Request::file('couverture');
			$couverture = $image->getClientOriginalName();
			Request::file('couverture')->move(base_path() . 'public/images/', $couverture);
		}
		else {
			$couverture = Request::input('couvertureHidden');
		}
		
		$manga = new Manga();
		
		try {
			if ($id_manga > 0)
				$manga->updateManga($id_manga, $titre, $couverture, $prix, $id_dessinateur, $id_genre, $id_scenariste);
			else
				$manga->insertManga($titre, $couverture, $prix, $id_dessinateur, $id_genre, $id_scenariste);
		} catch (Exception $ex) {
			$erreur = $ex->getMessage();
			
			if ($prix < 0)
				$erreur = "Le prix doit être strictement supérieur à 0.";
			
			if ($id_manga > 0)
				return $this->updateManga($id_manga, $erreur);
			else
				return $this->addManga($erreur);
		}
		
		return redirect('/listerMangas');
	}
	
	public function deleteManga($id_manga, $erreur = "") {
		$manga = new Manga();
		
		$manga->deleteManga($id_manga);
		$mangas = $manga->getMangas();
		
		return view('listeMangas', compact('mangas', 'erreur'));
	}
}
