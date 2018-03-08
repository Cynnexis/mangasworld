<?php

namespace App\Http\Controllers;

use App\modeles\Scenariste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScenaristeController extends Controller
{
	/**
	 * Afficher les scénaristes dans une liste déroulante
	 * @return Vue formGenre
	 */
	public function getScenaristes() {
		$erreur = Session::get('erreur');
		Session::forget('erreur');
		$scenariste = new Scenariste();
		$scenaristes = $scenariste->getScenaristes();
		return view('formGenre', compact('scenaristes', 'erreur'));
	}
}
