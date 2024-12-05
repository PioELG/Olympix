<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Compte extends BaseController
{
public function __construct()
{
    helper('form');
    $this->model = model(Db_model::class);
}
public function lister()
{
  
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
$data['titre']="Liste de tous les comptes";
$data['logins'] = $model->get_all_compte();
$data['nbCompte'] = $model ->total_compte();
return view('templates/haut2', $data)
.  view('affichage_comptes')
. view('templates/bas2');
}




public function creer()
{
    helper('form');
    $model = model(Db_model::class);
    $session = session();

  
    if ($session->has('user')) {
        $username = $session->get('user');
        $statutUser = $model->get_statutCompte($username);

        if ($statutUser) {
            $session->set('role', $statutUser->Statut);
        }
    }

    
    if (!$session->has('user') || $session->get('role') == "Jury") {
        return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }

    
    if ($this->request->getMethod() == "post") {
        
        if (!$this->validate([
            'nom' => 'required|max_length[255]|min_length[2]',
            'prenom' => 'required|max_length[255]|min_length[2]',
            'pseudo' => 'required|max_length[255]|min_length[2]',
            'mdp' => 'required|max_length[255]|min_length[8]',
            'role' => 'required|in_list[admin,jury]',
        ], [
            'nom' => ['required' => 'Veuillez entrer un nom pour le compte !'],
            'prenom' => ['required' => 'Veuillez entrer un prénom pour le compte !'],
            'pseudo' => ['required' => 'Veuillez entrer un pseudo pour le compte !'],
            'mdp' => [
                'required' => 'Veuillez entrer un mot de passe !',
                'min_length' => 'Le mot de passe saisi est trop court !',
            ],
            'role' => [
                'required' => 'Veuillez sélectionner un rôle !',
                'in_list' => 'Le rôle sélectionné est invalide !',
            ],
        ])) {
           
            return view('templates/haut2', ['titre' => 'Créer un compte'])
                . view('compte/compte_creer')
                . view('templates/bas2');
        }

        
        $recuperation = $this->request->getPost(); 

        if ($model->set_compte($recuperation) == false) {
            $data['erreur'] = "Impossible de créer ce compte";
        } else {
            $data['erreur'] = ""; // Aucune erreur
            $data['le_compte'] = $recuperation['pseudo'];
            $data['le_role'] = $recuperation['role'];
            $data['le_message'] = "Nouveau nombre de comptes :";
            $data['le_total'] = $model->get_nb_comptes(); // Récupération du total
        }

        
        return view('templates/haut2', $data)
            . view('compte/compte_succes')
            . view('templates/bas2');
    }

    
    return view('templates/haut2', ['titre' => 'Créer un compte'])
        . view('compte/compte_creer')
        . view('templates/bas2');
}


public function connecter()
 {
 
 $model = model(Db_model::class);
 // L’utilisateur a validé le formulaire en cliquant sur le bouton
 if ($this->request->getMethod()=="post"){
 if (! $this->validate([
 'pseudo' => 'required',
 'mdp' => 'required'
 ]))
 { // La validation du formulaire a échoué, retour au formulaire !
 return view('templates/haut', ['titre' => 'Se connecter'])
 . view('connexion/compte_connecter')
 . view('templates/bas');
 }
 // La validation du formulaire a réussi, traitement du formulaire
 $salt ="sel";
 $username=$this->request->getVar('pseudo');
 $password=$this->request->getVar('mdp');
 $passwordSalt = hash('sha256',$password.$salt);
 if ($model->connect_compte($username,$passwordSalt)==true)
 {
 $session=session();
 /*$session->set('user',$username);
 return view('templates/haut2')
 . view('connexion/compte_accueil')
 . view('templates/bas2');*/
 $session->set('user',$username);

 $data['statutUser'] = $model->get_statutCompte($username);

 $session->set('role',$data['statutUser']->Statut);


 if($data['statutUser']->Statut == "Admin")
 {
   $session->set('nom',$data['statutUser']->COA_nomAdmin);
   $session->set('prenom',$data['statutUser']->COA_prenomAdmin);
   $session->set('etat',$data['statutUser']->COA_Etat);
    // Si le statut recupéré est égal à admin on retourne le menu associé à l'admin
    return view('templates/haut2')
 . view('menu_administrateur')
 . view('templates/bas2');
 }
 else
 {
   $session->set('nom',$data['statutUser']->COJ_nomMembre);
   $session->set('prenom',$data['statutUser']->COJ_prenomMembre);
   $session->set('discipline',$data['statutUser']->COJ_disciplineExpertise);
   $session->set('url',$data['statutUser']->COJ_url);
   $session->set('etat',$data['statutUser']->COJ_Etat);

    return view('templates/haut2')
    . view('menu_organisateur')
    . view('templates/bas2');
 }
 
 }
 else
 { return view('templates/haut', ['titre' => 'Se connecter'])
 . view('connexion/compte_connecter')
 . view('templates/bas');
 }
 }
 // L’utilisateur veut afficher le formulaire pour se connecter
 
 return view('templates/haut', ['titre' => 'Se connecter'])
 . view('connexion/compte_connecter')
 . view('templates/bas');
 }

 public function afficher_profil()
 {
 $session=session();
 if ($session->has('user'))
 {
 $data['le_message']="Mon profil";
 // A COMPLETER...
 return view('templates/haut2',$data)
 . view('connexion/compte_profil')
 . view('templates/bas2');
 }
 else
 {
 return view('templates/haut', ['titre' => 'Se connecter'])
 . view('connexion/compte_connecter')
 . view('templates/bas');
 }
 }
 public function deconnecter()
 {
 $session=session();
 $session->destroy();
 return view('templates/haut', ['titre' => 'Se connecter'])
 . view('connexion/compte_connecter')
 . view('templates/bas');
 }

 public function modifier()
{
    helper(['form', 'url']);
    $data['titre'] = '';
    $session = session();
    $model = model(Db_model::class);

    if (!$session->has('user')) {
        return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }

    if ($this->request->getMethod() === 'post') {
        
      if (! $this->validate([
        'pseudo' => 'required',
        'nom' => 'required',
        'prenom' => 'required',
        'mdp' => 'required|min_length[8]',
        'mdp2' => 'required|matches[mdp]'
        
        ]))
        { // La validation du formulaire a échoué, retour au formulaire !
          $data['titre'] = 'Validation échouée.';
        return view('templates/haut2', $data)
        . view('connexion/modifier_profil')
        . view('templates/bas2');
        }

        // Récupération des données
        $pseudo = $this->request->getPost('pseudo');
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $mdp = $this->request->getPost('mdp');
        $salt = "sel";
        $mdpSalt = hash('sha256', $mdp . $salt);

        // Mise à jour dans la base de données
        if ($model->update_profil($pseudo, $mdpSalt)) {
            $data['titre'] = 'Informations bien modifiées.';
        } else {
            $data['titre'] = 'Erreur lors de la mise à jour.';
        }

        return view('templates/haut2', $data)
            . view('connexion/modifier_profil')
            . view('templates/bas2');
    }

  
    $data['le_message'] = "Modifier les informations associées à votre profil";
    return view('templates/haut2', $data)
        . view('connexion/modifier_profil')
        . view('templates/bas2');
}


 public function modifierDonnees()
 {

  
 $model = model(Db_model::class);
 $session = session();
  if (!$session->has('user')) {
        return view('templates/haut', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }
 // L’utilisateur a validé le formulaire en cliquant sur le bouton
 if ($this->request->getMethod()=="post"){
 if (! $this->validate([
 'pseudo' => 'required',
 'mdp' => 'required',
 'nom' => 'required',
 'prenom' => 'required'
 
 ]))
 { 
   $data['titre'] = 'Detail de cette candidature :';// La validation du formulaire a échoué, retour au formulaire !
 return view('templates/haut2', $data)
 . view('connexion/modifier_profil')
 . view('templates/bas2');
 }
 // La validation du formulaire a réussi, traitement du formulaire
 $salt ="sel";
 $pseudo=$this->request->getVar('pseudo');
 $nom=$this->request->getVar('nom');
 $prenom=$this->request->getVar('prenom');
 $mdp=$this->request->getVar('mdp');
 $mdp2=$this->request->getVar('mdp2');
 $mdpSalt = hash('sha256',$mdp.$salt);

 if($mdp==$mdp)
 {

 
 if ($model->update_profil($pseudo,$mdpSalt)==true)
 {
   //$data['le_message']="Informations bien modifiées";
   $data['titre'] = 'Detail de cette candidature :';
   return view('templates/haut2',$data)
   . view('connexion/modifier_profil')
   . view('templates/bas2');
  
 
 
 }
 else
 { 
   $data['titre'] = 'Detail de cette candidature :';
   return view('templates/haut2', $data)
   . view('connexion/modifier_profil')
   . view('templates/bas2');
 }
 }
 // L’utilisateur veut afficher le formulaire pour se connecter
 $data['titre'] = 'Detail de cette candidature :';
 return view('templates/haut2', $data)
 . view('connexion/modifier_profil')
 . view('templates/bas2');
 }

 }
}



