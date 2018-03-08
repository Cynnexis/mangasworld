<?php

namespace App\Http\Controllers;

use App\modeles\Manga;
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
}
