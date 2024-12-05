<?php
namespace App\Models;
use CodeIgniter\Model;
class Db_model extends Model
{
protected $db;
// Constructeur : initialise la connexion à la base de données
public function __construct()
{
$this->db = db_connect(); //charger la base de données
// ou
// $this->db = \Config\Database::connect();
}
   // Récupère tous les comptes avec leur rôle (admin ou jury) et informations supplémentaires
public function get_all_compte()
{
$resultat = $this->db->query("SELECT *,AdminOuPas(T_Compte_COM.COM_idCompte) AS role,T_CompteJury_COJ.*,T_CompteAdmin_COA.* FROM T_Compte_COM LEFT JOIN T_CompteJury_COJ ON T_Compte_COM.COM_idCompte = T_CompteJury_COJ.COM_idCompte LEFT JOIN T_CompteAdmin_COA ON T_Compte_COM.COM_idCompte = T_CompteAdmin_COA.COM_idCompte ORDER BY AdminOuPas(T_Compte_COM.COM_idCompte); ");
return $resultat->getResultArray();
}
// Compte le nombre total de comptes
public function total_compte()
{
$resultat = $this->db->query("SELECT COUNT(*) AS nb_comptes FROM T_Compte_COM;");
return $resultat->getRow();
}
 // Récupère une actualité spécifique par son identifiant
public function get_actualite($numero)
 {
 $requete="SELECT * FROM T_Actualite_ACT WHERE ACT_idActualite=".$numero.";";
 $resultat = $this->db->query($requete);
 return $resultat->getRow();
 }
 // Récupère toutes les actualités actives via une procédure 
 public function get_all_actualite()
 {
 $requete=" CALL GetAllActualite();";
 $resultat = $this->db->query($requete);
 return $resultat->getResultArray();
 }
  // Récupère les candidatures présélectionnées pour un concours donné
 public function get_preSelectionne($idConcours)
 {
    $requete = "SELECT * FROM vue_candidatures_preselectionnees WHERE CON_idConcours = '".$idConcours."';";
    $resultat = $this->db->query($requete);
    return $resultat->getResultArray();
 }


 
// Récupère tous les concours avec des informations détaillées et regroupées
public function get_all_concours()
 {
 $requete="SELECT T_Concours_CON.CON_idConcours,T_Concours_CON.CON_nomConcours,T_Concours_CON.CON_dateDebut ,T_Concours_CON.CON_edition, T_Concours_CON.CON_nbJoursCandidature ,T_Concours_CON.CON_nbJoursSelection,   ADDDATE(CON_dateDebut,CON_nbJoursCandidature) 
 AS datePreselection, ADDDATE(ADDDATE(CON_dateDebut,CON_nbJoursCandidature),CON_nbJoursPreSelection) 
 AS dateSelection , 	nom_phase(T_Concours_CON.CON_idConcours)
 AS phase, ADDDATE(ADDDATE(ADDDATE(CON_dateDebut,CON_nbJoursCandidature),CON_nbJoursPreSelection),CON_nbJoursSelection) 
 AS dateFinale,COA_nomAdmin,COA_prenomAdmin, GROUP_CONCAT(DISTINCT CAT_nomCategorie SEPARATOR '<br/>') 
 AS Catégories , GROUP_CONCAT(DISTINCT CONCAT(COJ_nomMembre, ' ', COJ_prenomMembre,' : Expert en ',COJ_disciplineExpertise) SEPARATOR '<br/>') 
 AS Jurys 
 FROM T_Concours_CON 
 LEFT JOIN 
 T_Partitions_PAR ON T_Concours_CON.CON_idConcours = T_Partitions_PAR.CON_idConcours 
 LEFT JOIN T_Categorie_CAT ON T_Partitions_PAR.CAT_idCategorie = T_Categorie_CAT.CAT_idCategorie 
 JOIN T_CompteAdmin_COA ON T_Concours_CON.COM_idCompte = T_CompteAdmin_COA.COM_idCompte 
 LEFT JOIN T_Juger_JUG ON T_Concours_CON.CON_idConcours = T_Juger_JUG.CON_idConcours 
 LEFT JOIN T_CompteJury_COJ ON T_Juger_JUG.COM_idCompte =T_CompteJury_COJ.COM_idCompte 
 GROUP BY T_Concours_CON.CON_idConcours 
 ORDER BY nom_phase(T_Concours_CON.CON_idConcours) ASC;";
 $resultat = $this->db->query($requete);
 return $resultat->getResultArray();
 }
// Récupère tous les concours où un jury spécifique est impliqué
 public function get_all_concoursJury($pseudo)
 {
 $requete="SELECT T_Concours_CON.CON_idConcours,T_Concours_CON.CON_nomConcours,T_Concours_CON.CON_dateDebut ,T_Concours_CON.CON_edition, T_Concours_CON.CON_nbJoursCandidature ,T_Concours_CON.CON_nbJoursSelection,   ADDDATE(CON_dateDebut,CON_nbJoursCandidature) 
 AS datePreselection, ADDDATE(ADDDATE(CON_dateDebut,CON_nbJoursCandidature),CON_nbJoursPreSelection) 
 AS dateSelection , 	nom_phase(T_Concours_CON.CON_idConcours)
 AS phase, ADDDATE(ADDDATE(ADDDATE(CON_dateDebut,CON_nbJoursCandidature),CON_nbJoursPreSelection),CON_nbJoursSelection) 
 AS dateFinale,COA_nomAdmin,COA_prenomAdmin, GROUP_CONCAT(DISTINCT CAT_nomCategorie SEPARATOR '<br/>') 
 AS Catégories , GROUP_CONCAT(DISTINCT CONCAT(COJ_nomMembre, ' ', COJ_prenomMembre,' : Expert en ',COJ_disciplineExpertise) SEPARATOR '<br/>') 
 AS Jurys 
 FROM T_Concours_CON 
 LEFT JOIN 
 T_Partitions_PAR ON T_Concours_CON.CON_idConcours = T_Partitions_PAR.CON_idConcours 
 LEFT JOIN T_Categorie_CAT ON T_Partitions_PAR.CAT_idCategorie = T_Categorie_CAT.CAT_idCategorie 
 JOIN T_CompteAdmin_COA ON T_Concours_CON.COM_idCompte = T_CompteAdmin_COA.COM_idCompte 
 LEFT JOIN T_Juger_JUG ON T_Concours_CON.CON_idConcours = T_Juger_JUG.CON_idConcours 
 LEFT JOIN T_CompteJury_COJ ON T_Juger_JUG.COM_idCompte =T_CompteJury_COJ.COM_idCompte 
 WHERE T_CompteJury_COJ.COM_idCompte = idJury('" . $pseudo . "')
 GROUP BY T_Concours_CON.CON_idConcours 
 ORDER BY nom_phase(T_Concours_CON.CON_idConcours) ASC;";
 $resultat = $this->db->query($requete);
 return $resultat->getResultArray();
 }

// Compte le nombre total de comptes
 public function get_nb_comptes()
{
// Fonction créée et testée dans le précédent tutoriel
$resultat=$this->db->query("SELECT COUNT(*) as nb FROM T_Compte_COM;");
return $resultat->getRow();
}
// Ajoute un nouveau compte (admin ou jury) si le pseudo n'existe pas encore
public function set_compte($saisie)
{
    
    $login = $saisie['pseudo'];
    $mot_de_passe = $saisie['mdp'];
    $nom = $saisie['nom'];
    $prenom = $saisie['prenom'];
    $role = $saisie['role'];

    
    $resultat1 = $this->db->query("SELECT COUNT(*) as nb FROM T_Compte_COM WHERE COM_pseudo = '" . $login . "';");
    $row = $resultat1->getRow();

    if ($row->nb == 0) { 
        $sql = "INSERT INTO T_Compte_COM VALUES(NULL, '" . $login . "', '" . $mot_de_passe . "');";
        $resulat = $this->db->query($sql);
        $id_compte = $this->db->insertID();

        
        if ($role == "admin") {
            $sql1 = "INSERT INTO T_CompteAdmin_COA VALUES('A', '" . $id_compte . "', '" . $nom . "', '" . $prenom . "');";
            $resulat1 = $this->db->query($sql1);
        } else if ($role == "jury") {
            $sql2 = "INSERT INTO T_CompteJury_COJ VALUES('" . $nom . "', '" . $prenom . "', 'Musique', 'site.com', '" . $id_compte . "', NULL, 'A');";
            $resulat2 = $this->db->query($sql2);
        }

        return true;
    } else {
        return false; 
    }
}

// Ajoute un nouveau concours à la base de données

public function set_concours($saisie,$user)
{
//Récuparation (+ traitement si nécessaire) des données du formulaire
$nomConcours=$saisie['nomConcours'];
$edition=$saisie['edition'];
$dateDebut = $saisie['dateDebut'];
$nbCand = $saisie['nbCand'];
$nbPre = $saisie['nbPre'];
$nbSelect = $saisie['nbSelect'];

$sql = "INSERT INTO T_Concours_CON 
        VALUES(NULL, '".$nomConcours."', '".$dateDebut."', '".$nbCand."', '".$nbSelect."', '".$edition."', id_Admin('".$user."'), '".$nbPre."');";

$resulat = $this->db->query($sql);

return $resulat;
}

// Récupère les informations d'une candidature spécifique
public function get_candidature($code)
 {
 /*$requete="SELECT * FROM T_Candidature_CAN WHERE CAN_CodeInscription='".$code."';";*/
/* $requete="SELECT T_Candidature_CAN.*, GROUP_CONCAT(CONCAT('https://obiwan.univ-brest.fr/~e22406560/',DOC_nomDocument) SEPARATOR '<br>') AS documents FROM T_Candidature_CAN */
$requete = "SELECT T_Candidature_CAN.*,    GROUP_CONCAT( CONCAT('<a href= ',  'https://obiwan.univ-brest.fr/~e22406560/documents/',  DOC_nomDocument, '>', DOC_nomDocument, '</a>')  SEPARATOR '<br>' ) AS documents,T_Categorie_CAT.CAT_nomCategorie as Categorie, T_Concours_CON.CON_nomConcours as Concours
FROM 
    T_Candidature_CAN 
LEFT JOIN 
    T_Document_DOC ON T_Candidature_CAN.CAN_idCandidature = T_Document_DOC.CAN_idCandidature
JOIN
    T_Concours_CON ON T_Candidature_CAN.CON_idConcours = T_Concours_CON.CON_idConcours
JOIN
    T_Categorie_CAT ON T_Candidature_CAN.CAT_idCategorie = T_Categorie_CAT.CAT_idCategorie
WHERE 
    CAN_CodeInscription = '" . $code . "'
GROUP BY 
    T_Candidature_CAN.CAN_idCandidature;
";
 
 $resultat = $this->db->query($requete);
 return $resultat->getRow();
 }
 // Vérifie si une candidature existe avec un code d'inscription et un code d'identification donnés
 public function nbCandidature($u,$p)
 {
 $sql="SELECT *
 FROM T_Candidature_CAN
 WHERE CAN_CodeInscription='".$u."'
 AND CAN_CodeIdentification='".$p."';";
 $resultat=$this->db->query($sql);
 if($resultat->getNumRows() > 0)
 {
 return true;
 }
 else
 {
 return false;
 }
 }

  // Vérifie les identifiants de connexion d'un compte
 public function connect_compte($u,$p)
 {
 $sql="SELECT COM_pseudo,COM_motDePasse
 FROM T_Compte_COM
 WHERE COM_pseudo='".$u."'
 AND COM_motDePasse='".$p."';";
 $resultat=$this->db->query($sql);
 if($resultat->getNumRows() > 0)
 {
 return true;
 }
 else
 {
 return false;
 }
 }

    // Récupère le statut et les informations d'un compte donné
 public function get_statutCompte($login)
{

$requete = "SELECT T_Compte_COM.*, T_CompteJury_COJ.*, T_CompteAdmin_COA.*, AdminOuPas(T_Compte_COM.COM_idCompte) as Statut FROM T_Compte_COM LEFT JOIN T_CompteJury_COJ ON T_Compte_COM.COM_idCompte = T_CompteJury_COJ.COM_idCompte LEFT JOIN T_CompteAdmin_COA ON T_Compte_COM.COM_idCompte = T_CompteAdmin_COA.COM_idCompte WHERE T_Compte_COM.COM_pseudo = '" . $login . "';";


$resultat = $this->db->query($requete);
return $resultat->getRow();
}
// Met à jour le mot de passe d'un compte spécifique
public function update_profil ($pseudo,$mdp)
{
    $requete = "UPDATE T_Compte_COM SET COM_motDePasse = '" . $mdp . "' WHERE T_Compte_COM.COM_pseudo = '" . $pseudo . "'; ";
    return $this->db->query($requete);
}
 // Supprime une candidature et ses documents associés
public function delete_candidature($codeIns)
{
   /* $requete1 = "DELETE FROM T_Document_DOC WHERE CAN_idCandidature = idCandidat('" . $codeIns . "'); ";
    $result=  $this->db->query($requete1);
    $requete2 = "DELETE FROM T_Evalue_EVA WHERE CAN_idCandidature = idCandidat('" . $codeIns . "'); ";
    $result2=  $this->db->query($requete2);*/
    $requete = "DELETE FROM T_Candidature_CAN WHERE CAN_CodeInscription = '" . $codeIns . "'; ";
   
   
    return $this->db->query($requete);
}
 // Supprime un concours de la base de données
public function delete_concours($idConcours)
{
  

    $requete = "DELETE FROM T_Concours_CON WHERE CON_idConcours = '" . $idConcours . "'; ";
   
   
    return $this->db->query($requete);
}

}