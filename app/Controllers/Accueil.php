<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Accueil extends BaseController
{
/*public function afficher()
{
  
    return view('templates/haut').view('affichage_accueil.php'). view('templates/bas');
}*/


public function admin()
{
return view('templates/haut2').view('menu_administrateur')
. view('templates/bas2');
}

public function lister()
{
$model = model(Db_model::class);
$data['titre']="Liste de toutes les actualités";
$data['actus'] = $model->get_all_actualite();

return view('templates/haut', $data)
. view('affichage_accueil')
. view('templates/bas');
}


}
?>
