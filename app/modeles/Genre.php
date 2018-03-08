<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;

class Genre extends Model
{
    /**
     * Liste des genres
     * @return collection de Genre
     */
    public function getGenres() {
    	$genres = DB::table('genre')->get();
    	return $genres;
    }
}
