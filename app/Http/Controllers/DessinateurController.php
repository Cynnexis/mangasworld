<?php

namespace App\Http\Controllers;

use App\modeles\Dessinateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DessinateurController extends Controller
{
	/**
	 * Afficher les dessinateurs dans une liste déroulante
	 * @return Vue formGenre
	 */
	public function getGenres() {
		$erreur = Session::get('erreur');
		Session::forget('erreur');
		$dessinateur = new Dessinateur();
		$dessinateurs = $dessinateur->getDessinateurs();
		return view('formGenre', compact('dessinateurs', 'erreur'));
	}
}
