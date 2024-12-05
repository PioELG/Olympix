<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Concours extends BaseController
{
 public function __construct()
 {
 //...
 }


 public function lister()
{
    helper('form');
$model = model(Db_model::class);
  
$data['titre']="Liste de tous les concours";
$data['concours'] = $model->get_all_concours();

return view('templates/haut', $data)
. view('affichage_concours')
. view('templates/bas');
}
public function listerAdmin()
{
    helper('form');
    $session=session();
   
 if ($session->has('user'))
 {
$model = model(Db_model::class);
$username = $session ->get('user');
  $data['statutUser'] = $model->get_statutCompte($username);

  $session->set('role',$data['statutUser']->Statut);

  if ($session->get('role')=="Jury") {
  
    
    return view('templates/haut', ['titre' => 'Se connecter'])
    . view('connexion/compte_connecter')
    . view('templates/bas');
  
   
}


$data['titre']="Liste de tous les concours";
$data['concours'] = $model->get_all_concours();

return view('templates/haut2', $data)
. view('affichage_concoursAdmin')
. view('templates/bas2');
}
else {
    $model = model(Db_model::class);
    $data['titre']="Liste de toutes les actualités";
$data['actus'] = $model->get_all_actualite();
    return view('templates/haut', $data)
. view('affichage_accueil')
. view('templates/bas');
}
}
public function listerJury()
{
    helper('form');
    $session=session();
 if ($session->has('user'))
 {
$model = model(Db_model::class);

$username = $session ->get('user');
  $data['statutUser'] = $model->get_statutCompte($username);

  $session->set('role',$data['statutUser']->Statut);

  if ($session->get('role')=="Admin") {
  
    
    return view('templates/haut', ['titre' => 'Se connecter'])
    . view('connexion/compte_connecter')
    . view('templates/bas');
  
   
}

$data['titre']="Liste de tous les concours";
$pseudo =  session()->get('user');
$data['concours'] = $model->get_all_concoursJury($pseudo);


return view('templates/haut2', $data)
. view('affichage_concoursJury')
. view('templates/bas2');
}
else {
    $model = model(Db_model::class);
    $data['titre']="Liste de toutes les actualités";
$data['actus'] = $model->get_all_actualite();
    return view('templates/haut', $data)
. view('affichage_accueil')
. view('templates/bas');
}
}

public function creer()
{
helper('form');
$model = model(Db_model::class);
$session = session();
if($session->has('user'))
{
  $username = $session ->get('user');
  $data['statutUser'] = $model->get_statutCompte($username);

  $session->set('role',$data['statutUser']->Statut);
}
if (!$session->has('user')||$session->get('role')=="Jury") {
  
    
      return view('templates/haut', ['titre' => 'Se connecter'])
      . view('connexion/compte_connecter')
      . view('templates/bas');
    
     
  }
$data['le_message']=" Concours créé avec succès: ";

// L’utilisateur a validé le formulaire en cliquant sur le bouton
if ($this->request->getMethod()=="post")
{
if (! $this->validate([
'nomConcours' => 'required|max_length[255]|min_length[2]',
'edition' => 'required|max_length[255]|min_length[2]',
'dateDebut' => 'required',
'nbCand' => 'required',
'nbPre' => 'required',
'nbSelect' => 'required',
], [ // Configuration des messages d’erreurs
   'nomConcours' => [
    'required' => 'Veuillez entrer un nom pour le concours !',
    ],
    'edition' => [
    'required' => 'Veuillez entrer une édition pour le concours !',
    ],
    'dateDebut' => [
    'required' => 'Veuillez entrer une date de début pour le concours !',
    ],
    'nbCand' => [
    'required' => 'Veuillez entrer un nombre de jours de candidature pour le concours !',
    
    ],

    'nbPre' => [
    'required' => 'Veuillez entrer un nombre de jours de préselection pour le concours !',
    
    ],
    'nbSelect' => [
    'required' => 'Veuillez entrer un nombre de jours de sélection pour le concours !',
    
    ],
    ]   ))
{
// La validation du formulaire a échoué, retour au formulaire !
return view('templates/haut2', ['titre' => 'Créer un concours'])
. view('concours/concours_creer')
. view('templates/bas2');
}
// La validation du formulaire a réussi, traitement du formulaire
$recuperation = $this->validator->getValidated();
$session = session();
$user =  $session->get('user');
if ($model->set_concours($recuperation,$user))
{

    //Appel de la fonction créée dans le précédent tutoriel :
    //$data['le_total']=$model->get_nb_comptes();
    return redirect()->to(base_url("index.php/concours/listerAdmin"))
                    ->with('message', 'Le concours a été créé avec succès');
    }
}



// L’utilisateur veut afficher le formulaire pour créer un compte
return view('templates/haut2', ['titre' => 'Créer un concours'] )
. view('concours/concours_creer')
. view('templates/bas2');
}



public function supprimer($idConcours)
{
    $session = session();
    $model = model(Db_model::class);
if($session->has('user'))
{
  $username = $session ->get('user');
  $data['statutUser'] = $model->get_statutCompte($username);

  $session->set('role',$data['statutUser']->Statut);
}
if (!$session->has('user')||$session->get('role')=="Jury") {
  
    
      return view('templates/haut', ['titre' => 'Se connecter'])
      . view('connexion/compte_connecter')
      . view('templates/bas');
    
     
  }
    
    
    
   
    $model->delete_concours($idConcours);
    
   
    return redirect()->to(base_url("index.php/concours/listerAdmin"));
                    
}


}