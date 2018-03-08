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
    
    /**
     * Lecture de tous les mangas d'un genre
     * @param int $id_genre : id du genre
     * @return Collection de Manga
     */
    public function getMangasGenre($id_genre) {
    	$mangas = DB::table('manga')
		            ->Select('id_manga', 'titre', 'genre.lib_genre', 'dessinateur.nom_dessinateur', 'scenariste.nom_scenariste', 'prix')
    	            ->where('manga.id_genre', '=', $id_genre)
		            ->join('genre', 'manga.id_genre', '=', 'genre.id_genre')
		            ->join('dessinateur', 'manga.id_dessinateur', '=', 'dessinateur.id_dessinateur')
    	            ->join('scenariste', 'manga.id_scenariste', '=', 'scenariste.id_scenariste')
		            ->get();
    	return $mangas;
    }
    
    /**
     * Lecture d'un manga sur son Id
     * @param int $idManga id à lire
     * @return Objet Manga
     */
    public function getManga($idManga) {
    	$manga = DB::table('manga')
		    ->select()
		    ->where('id_manga', '=', $idManga)
		    ->first();
    	
    	return $manga;
    }
}
