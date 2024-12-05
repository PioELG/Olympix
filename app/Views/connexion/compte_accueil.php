<div id="layoutSidenav_content">
<div class="container-fluid px-4">
<h2>Espace d'administration</h2>
<br />
<h2>Session ouverte ! Bienvenue
<?php
$session=session();
echo $session->get('user');
?> !
</h2>
</div>

</div>