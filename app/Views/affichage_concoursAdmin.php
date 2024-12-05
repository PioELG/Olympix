<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url();?>index.php/compte/afficher_profil">Mon profil</a></li>
                        <li><a class="dropdown-item" href="#!">Log de mes activités</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url();?>index.php/compte/deconnecter">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Gestion des comptes</div>
                            <a class="nav-link" href="<?php echo base_url();?>index.php/compte/lister">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Comptes
                            </a>
                            
                               
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                               
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                               
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                
                            </div>
                            <div class="sb-sidenav-menu-heading">Gestion des Concours</div>
                            <a class="nav-link" href="<?php echo base_url();?>index.php/concours/listerAdmin">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Concours
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Actualités
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <p id="datetime"><?php
                        date_default_timezone_set('Europe/Paris'); // Définit le fuseau horaire
    echo date('d/m/Y H:i:s'); ?></p>

<script>
    function updateTime() {
        const now = new Date();
        const formattedTime = now.toLocaleString('fr-FR', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
        });
        document.getElementById('datetime').textContent = formattedTime;
    }

    // Actualiser chaque seconde
    setInterval(updateTime, 1000);
</script>

                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    </br>  </br> 
                    <h2><?php echo $titre; ?></h2>
</br>  </br>                  
                 
<a href="<?php echo base_url();?>index.php/concours/creer" >
    <i class="fa-solid fa-plus fa-2x" style="text-decoration: none;color: black;"      ></i>
</a> <br>

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
                    <i class="fa-solid fa-plus"      ></i> &nbsp;&nbsp;   
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

              <?php if($con["phase"] == "A venir" ) { ?>


                <form action="<?= site_url('concours/supprimer/' . $con["CON_idConcours"]) ?>" method="post">
        <input type="hidden" name="code_identification" value="<?= $con["CON_idConcours"]?>">
        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce concours ?');" class="btn-delete"    >
        <i class="fa-solid fa-trash"></i>
        </button>
</form>

                  
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
                          
                       
                </main>



<style>
    .btn-delete {
        background: none; /* Supprime le fond par défaut */
        border: none; /* Supprime la bordure */
        cursor: pointer; /* Ajoute le pointeur */
    }

    .btn-delete:focus {
        outline: none; /* Supprime le contour de focus */
    }

    .btn-delete:hover {
        color: red; /* Optionnel : Change la couleur de l'icône au survol */
    }
</style>

              