<h1><?php echo $titre;?></h1><br />

<?php
if (isset($candidature))
{ ?>
 <table class="table table-hover">
    <thead>
        <tr>
            <th>NomCandidat</th>
            <th>PrenomCandidat</th>
            <th>CodeInscription</th>
            <th>CodeIdentification</th>
            <th>Categorie</th>
            <th>Concours</th>
            <th>Statut</th>
            <th> Documents </th>

   </tr>
    </thead>
    <tbody>
       
            <tr>
                <td><?php echo $candidature->CAN_nomCandidat; ?></td>
                <td><?php echo$candidature->CAN_prenomCandidat; ?></td>
                <td><?php echo$candidature->CAN_CodeInscription; ?></td>
                <td><?php echo$candidature->CAN_CodeIdentification; ?></td>
                <td><?php echo$candidature->Categorie; ?></td>
                <td><?php echo$candidature->Concours; ?></td>
                <td><?php echo$candidature->CAN_Active; ?></td>
                <td><?php echo$candidature->documents; ?></td>
                
            </tr>

       
    </tbody>
</table>

<form action="<?= site_url('candidature/supprimer/' . $candidature->CAN_CodeInscription) ?>" method="post">
        <input type="hidden" name="code_identification" value="<?= $candidature->CAN_CodeInscription ?>">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette candidature ?');">
            Supprimer Candidature
        </button>
</form>

<?php } 

else {
    echo("<h3>Aucune candidature associée aux codes fournis pour le moment</h3>");
   }
    
        ?>

   



 