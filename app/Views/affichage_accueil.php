<h2><?php echo $titre; ?></h2>

<?php
if ( ! empty($actus) && is_array($actus))
{ ?>
 <table class="table table-hover">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Date de Publication</th>
            <th>Auteur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($actus as $actu) {?>
            <tr>
                <td><?php echo $actu["ACT_Titre"]; ?></td>
                <td><?php echo $actu["ACT_texteActualite"]; ?></td>
                <td><?php echo $actu["ACT_datePub"]; ?></td>
                <td><?php echo $actu["auteur"]; ?></td>
            </tr>
        <?php } 

}
else {
    echo("<h3>Aucune Actualite pour le moment</h3>");
   }
    
        ?>
    </tbody>
</table>



   



 