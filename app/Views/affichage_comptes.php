<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
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
                    <p id="datetime">
                        <?php
                        date_default_timezone_set('Europe/Paris');
                        echo date('d/m/Y H:i:s');
                        ?>
                    </p>
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
                        setInterval(updateTime, 1000);
                    </script>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2><?php echo $titre; ?></h2>
                            <a href="<?php echo base_url();?>index.php/compte/creer" style="text-decoration: none;color: black;">
                                <i class="fa-solid fa-plus fa-2x"></i>
                            </a>
                            <br>
                            <?php if (!empty($logins) && is_array($logins)) { ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Pseudo</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Rôle</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($logins as $login) { ?>
                                            <tr>
                                                <td><?php echo $login["COM_pseudo"]; ?></td>
                                                <td><?php echo $login["role"] === 'Jury' ? $login["COJ_nomMembre"] : $login["COA_nomAdmin"]; ?></td>
                                                <td><?php echo $login["role"] === 'Jury' ? $login["COJ_prenomMembre"] : $login["COA_prenomAdmin"]; ?></td>
                                                <td><?php echo $login["role"]; ?></td>
                                                <td>
                                                    <?php
                                                    if ($login["role"] === 'Jury') {
                                                        echo $login["COJ_Etat"] === 'A' ? 'Actif' : 'Désactivé';
                                                    } else {
                                                        echo $login["COA_Etat"] === 'A' ? 'Actif' : 'Désactivé';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <h3>Aucun compte pour le moment</h3>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
