<h2><?php echo $titre; ?></h2>

<?php
if ( ! empty($concours) && is_array($concours))
{ ?>
 <table class="table table-hover">
    <thead>
        <tr>
            <th>NomConcours</th>
            <th>Date de Debut</th>
            <th>Date de Debut de Preselection</th>
            <th>Date de Debut de Selection</th>
            <th>Date de la Finale</th>
            <th>Phase</th>
            <th>Categories</th>
            <th>Jurys</th>
            <th>Organisateur</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($concours as $con) {?>
            <tr>
                <td><?php echo $con["CON_nomConcours"]; ?></td>
                <td><?php echo $con["CON_dateDebut"]; ?></td>
                <td><?php echo $con["datePreselection"]; ?></td>
                <td><?php echo $con["dateSelection"]; ?></td>
                <td><?php echo $con["dateFinale"]; ?></td>
                <td><?php echo $con["phase"]; ?></td>
                <td><?php 
                if ($con["Catégories"]=="") 
                {
                    echo "Aucune catégorie";
                }
                else{
                    echo $con["Catégories"]; 
                }
                ?></td>
                <td><?php 
                if( $con["Jurys"] == "")
                {
                    echo "Aucun Jury";
                }
                else
                {
                    echo $con["Jurys"]; 
                }
                
                ?></td>
                <td><?php echo $con["COA_prenomAdmin"]." ".$con["COA_nomAdmin"]; ?></td>
                <td>  
                <?php if($con["phase"] == "Candidature") { ?>
                    <i class="fa-solid fa-plus"></i> &nbsp;&nbsp;   
              <?php } ?>
                    <i class="fa-solid fa-magnifying-glass"></i> &nbsp;&nbsp;

                     
                    <?php if($con["phase"] == "Selection" || $con["phase"] == "Terminé" ) { ?>
                        <a href="<?php echo base_url();?>index.php/candidature/candidaturePre/<?php echo $con["CON_idConcours"]; ?>" style="text-decoration: none;color: black;">
                        <i class="fa-solid fa-users"></i> &nbsp;&nbsp;   
                     </a>
              <?php } ?> 
                    
               <?php if($con["phase"] == "Terminé" ) { ?>
                    <i class="fa-solid fa-trophy"></i>
              <?php } ?>
                </td>
            </tr>
        <?php } 

}
else {
    echo("<h3>Aucun concours pour le moment</h3>");
   }
    
        ?>
    </tbody>
</table>



   



 