<?php

//$uploaddir = '/home/2024DIFAL3/exxxxxxx/public_html/gabarit/front_office/documents/';

$mysqli = new mysqli('obiwan.univ-brest.fr','e22406560sql','5PNiyGMO','e22406560_db2');
 if ($mysqli->connect_errno) {
    echo "Error: Problème de connexion à la BDD \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    // Arrêt du chargement de la page
    exit();
  }


$uploaddir = __DIR__. '/documents/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$fileName=basename($_FILES['userfile']['name']);
echo $uploadfile;
echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
 echo "Le fichier est valide, et a été téléchargé
 avec succès. Voici plus d'informations :\n";

// $requete = "INSERT INTO T_DOCUMENT_DOC  VALUES ($uploadfile);";
 //$result = $mysqli ->query($requete);

 $requete = $mysqli->prepare("INSERT INTO T_Document_DOC VALUES (NULL,?)");

 // Liaison de la variable
 $requete->bind_param("s", $fileName);
 
 // Exécution de la requête
 $result = $requete->execute();


  if ($result == false) //Erreur lors de l’exécution de la requête
  {
   // La requête a echoué
   echo "Error: La requête a échoué \n";
   echo "Query: " . $requete . "\n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit;
  }
  else //Requête réussie
  {
  echo "<br />";
  echo "Bien enregistré dans la BD  !" . "\n";
  }


 } else {
 echo "Le fichier n’a pas été téléchargé. Il y a eu un problème !\n";
}
echo 'Voici quelques informations sur le téléversement :';
print_r($_FILES);
?>