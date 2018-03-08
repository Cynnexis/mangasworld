<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dessinateur extends Model
{
	/**
	 * Liste des dessinateurs
	 * @return collection de Genre
	 */
	public function getDessinateurs() {
		$dessinateurs = DB::table('dessinateur')->get();
		return $dessinateurs;
	}
}
