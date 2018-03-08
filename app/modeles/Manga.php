<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;

class Manga extends Model
{
    public function getMangas() {
    	$mangas = DB::table('manga')
		    ->Select('id_manga', 'titre', 'genre.lib_genre', 'dessinateur.nom_dessinateur', 'scenariste.nom_scenariste', 'prix')
		    ->join('genre', 'manga.id_genre', '=', 'genre.id_genre')
		    ->join('dessinateur', 'manga.id_dessinateur', '=', 'dessinateur.id_dessinateur')
		    ->join('scenariste', 'manga.id_scenariste', '=', 'scenariste.id_scenariste')
		    ->get();
    	
    	return $mangas;
    }
}
