<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Actualite extends BaseController
{
 public function __construct()
 {
 //...
 }

 public function afficher($numero = 0)
 {
 $model = model(Db_model::class);

 if ($numero == 0)
 {
 return redirect()->to('/');
 }
 else{
 $data['titre'] = 'Actualité :';
$data['news'] = $model->get_actualite($numero);
return view('templates/haut', $data)
 . view('affichage_actualite')
 . view('templates/bas');
}
 }

 public function lister()
{
$model = model(Db_model::class);
$data['titre']="Liste de toutes les actualités";
$data['actus'] = $model->get_all_compte();

return view('templates/haut', $data)
. view('affichage_acceuil')
. view('templates/bas');
}
}