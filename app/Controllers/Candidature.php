<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Candidature extends BaseController
{
   


 public function __construct()
 {
 //...
 }

public function afficher($code = "")
 {
 $model = model(Db_model::class);

 if ($code == "")
 {
 return redirect()->to('/');
 }
 else{
 $data['titre'] = 'Detail de cette candidature :';
$data['candidature'] = $model->get_candidature($code);
return view('templates/haut', $data)
 . view('affichage_candidature')
 . view('templates/bas');
}


 }

 public function afficherFormulaire()
 {
    helper('form');
 $model = model(Db_model::class);
 $data = ['titre' => ''];
 if ($this->request->getMethod()=="post"){
    if (! $this->validate([
    'codeIns' => 'required',
    'codeId' => 'required'
    ]))
    {
        return view('templates/haut')
 . view('formulaire_candidature')
 . view('templates/bas');
 }

 $codeIns=$this->request->getVar('codeIns');
 $codeId=$this->request->getVar('codeId');
 
 
 if ($model->nbCandidature($codeIns,$codeId)==true)
 {
    
 
     return redirect()->to(base_url("index.php/candidature/afficher/$codeIns"));
 }
 $data['titre'] = 'Aucune candidature associée. Veuillez revérifier les codes saisis .';
 }
 return view('templates/haut',$data)
 . view('formulaire_candidature')
 . view('templates/bas');

 
 }
 
 public function supprimer($code_identification)
{
    
    $model = model(Db_model::class);
    
   
    $model->delete_candidature($code_identification);
    
   
    return redirect()->to(base_url("index.php/candidature/afficherFormulaire"))
                    ->with('message', 'La candidature a été supprimée avec succès');
                    
}

public function candidaturePre($idConcours)
{
    $model = model(Db_model::class);
    $data['titre']="Galerie des candidats préselectionnés ";
    $data['candidature'] = $model->get_preSelectionne($idConcours);

    return view('templates/haut2',$data)
    .view('affichage_preselect');
}

}