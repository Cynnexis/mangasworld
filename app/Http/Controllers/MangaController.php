<?php

namespace App\Http\Controllers;

use App\modeles\Manga;
use Illuminate\Http\Request;
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
}
