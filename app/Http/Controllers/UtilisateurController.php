<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use Request;
use App\modeles\Utilisateur;

class UtilisateurController extends Controller
{
	/**
	 * Initialise le formulaire d'authentification
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View formLogin
	 */
    public function getLogin() {
    	$erreur = "";
    	return view('formLogin', compact('erreur'));
    }
    
    public function signIn() {
    	$login = Request::input('login');
    	$pwd = Request::input('pwd');
    	
    	$utilisateur = new Utilisateur();
    	$connected = $utilisateur->login($login, $pwd);
    	
    	if ($connected) {
    		return view('home');
	    }
	    else {
    		$erreur = "Login ou mot de passe inconnu";
    		return view('formLogin', compact('erreur'));
	    }
    }
    
    public function signOut() {
    	$utilisateur = new Utilisateur();
    	$utilisateur->logout();
    	return view('home');
    }
}
?>

