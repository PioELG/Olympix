
<?php
if($erreur =="")
{
    echo "Bravo ! Formulaire rempli, le compte suivant a été ajouté :<br>";
    if (isset($le_compte)) {
        echo "Compte : " . htmlspecialchars($le_compte) . "<br>";
    }
    if (isset($le_message)) {
        echo "Message : " . htmlspecialchars($le_message) . "<br>";
    }
    if (isset($le_role)) {
        echo "Rôle : " . htmlspecialchars($le_role) . "<br>";
    }
    if (isset($le_total->nb)) {
        echo "Total : " . htmlspecialchars($le_total->nb) . "<br>";
    }
}
else
{
    echo $erreur;
}

?>