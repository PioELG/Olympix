<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

use App\Controllers\Accueil;
//$routes->get('accueil/afficher', [Accueil::class, 'afficher']);


/*$routes->get('accueil/lister', [Accueil::class, 'lister']);  Page d'acceuil dont j'ai modifier le chemin d'accès*/
$routes->get('/', [Accueil::class, 'lister']);
$routes->get('/accueil/admin', [Accueil::class, 'admin']);

use App\Controllers\Compte;
$routes->get('compte/lister', [Compte::class, 'lister']);
$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);
$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);
$routes->get('compte/modifier', [Compte::class, 'modifier']);
$routes->post('compte/modifier', [Compte::class, 'modifier']);

use App\Controllers\Actualite;
$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);

use App\Controllers\Concours;
$routes->get('concours/lister', [Concours::class, 'lister']);
$routes->get('concours/listerAdmin', [Concours::class, 'listerAdmin']);
$routes->get('concours/listerJury', [Concours::class, 'listerJury']);
$routes->get('concours/creer', [Concours::class, 'creer']);
$routes->post('concours/creer', [Concours::class, 'creer']);
$routes->post('concours/supprimer/(:num)', 'Concours::supprimer/$1');
use App\Controllers\Candidature;
$routes->get('candidature/afficher', [Candidature::class, 'afficher']);
$routes->get('candidature/afficher/(:segment)', [Candidature::class, 'afficher']);
$routes->get('candidature/candidaturePre/(:num)', [Candidature::class, 'candidaturePre']);
$routes->get('candidature/afficherFormulaire', [Candidature::class, 'afficherFormulaire']);
$routes->post('candidature/afficherFormulaire', [Candidature::class, 'afficherFormulaire']);
$routes->post('candidature/supprimer/(:segment)', 'Candidature::supprimer/$1');

?>