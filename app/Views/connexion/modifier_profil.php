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
                        <?php  $session = session(); if ($session->get('role') == "Admin") { ?>
                            <div class="sb-sidenav-menu-heading">Gestion des comptes</div>
                            <a class="nav-link" href="<?php echo base_url();?>index.php/compte/lister">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Comptes
                            </a>

                            <?php
                                    }
                                    ?>
                        
                            
                           
                            
                            <div class="sb-sidenav-menu-heading">Gestion des concours</div>
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
</br>
                        <h2>Modifier votre profil</h2>
                        <?= session()->getFlashdata('error') ?>
                        <?php echo form_open('/compte/modifier'); ?>
                        <?= csrf_field() ?>

                       
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" id="inputNom" type="text" name="nom" placeholder="Nom" value="<?= set_value('nom', session()->get('nom')) ?>">
                <label for="inputNom">Nom</label>
            </div>
            <?= validation_show_error('nom') ?>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" id="inputPrenom" type="text" name="prenom" placeholder="Prenom" value="<?= set_value('prenom', session()->get('prenom')) ?>">
                <label for="inputPrenom">Prénom</label>
            </div>
            <?= validation_show_error('prenom') ?>
        </div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control" id="inputPseudo" type="text" name="pseudo" placeholder="Pseudo" value="<?= set_value('pseudo', session()->get('user')) ?> " <?php $session = session();
         if ($session->get('role') == "Jury") { ?>  readonly <?php }?>>
        <label for="inputPseudo">Pseudo</label>
    </div>
    <?= validation_show_error('pseudo') ?>

    <?php 
    $session = session();
    if ($session->get('role') == "Jury") { ?>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="inputDiscipline" type="text" name="discipline" placeholder="Discipline" value="<?= set_value('discipline', session()->get('discipline')) ?>">
                    <label for="inputDiscipline">Discipline</label>
                </div>
                <?= validation_show_error('discipline') ?>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="inputUrl" type="text" name="url" placeholder="URL" value="<?= set_value('url', session()->get('url')) ?>">
                    <label for="inputUrl">URL</label>
                </div>
                <?= validation_show_error('url') ?>
            </div>
        </div>
    <?php } ?>

    <div class="form-floating mb-3">
        <input class="form-control" id="inputMdp" type="password" name="mdp" placeholder="Mot de passe">
        <label for="inputMdp">Mot de passe</label>
    </div>
    <?= validation_show_error('mdp') ?>

    <div class="form-floating mb-3">
        <input class="form-control" id="inputMdp2" type="password" name="mdp2" placeholder="Mot de passe">
        <label for="inputMdp">Confrmation du mot de passe</label>
    </div>
    <?= validation_show_error('mdp2') ?>



    <div class="mt-4 mb-0">
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary" type="submit" name="submit">Valider</button>
        <a class="btn btn-secondary" href="javascript:history.go(-2)">Annuler</a>
    </div>
    <?php echo $titre; ?>
</div>
</form>





                            </a>
                            
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                               
                            </div>
                            <div class="col-xl-3 col-md-6">
                                
                            </div>
                            <div class="col-xl-3 col-md-6">
                               
                            </div>
                            <div class="col-xl-3 col-md-6">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                            

                               
                            </div>
                           
                        </div>
                        <div class="card mb-4">
                            
                            
                        </div>
                    </div>
                </main>
              