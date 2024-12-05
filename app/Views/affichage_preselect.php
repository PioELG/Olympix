<h1><?php echo $titre; ?></h1><br />

<?php
if (!empty($candidature) && is_array($candidature)) {
?>
<div class="mosaic-container">
    <?php foreach ($candidature as $cand) { ?>
    <div class="mosaic-card">
        <h2><?php echo $cand["CAN_nomCandidat"] . " " . $cand["CAN_prenomCandidat"]; ?></h2>
        <p><strong>Catégorie :</strong> <?php echo $cand["Categorie"]; ?></p>
        <p><strong>Concours :</strong> <?php echo $cand["Concours"]; ?></p>
        <p><strong>Statut :</strong> <?php echo $cand["CAN_Active"] ;?></p>
        <p ><strong>Documents :</strong> <?php echo $cand["documents"]; ?></p>
    </div>
    <?php } ?>
</div>

<?php
} else {
    echo("<h3>Aucune candidature n'est encore préselectionnée</h3>");
}
?>

<style>
    .mosaic-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
        gap: 20px;
        padding: 20px;
    }

    .mosaic-card {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px; 
        text-align: left;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .mosaic-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .mosaic-card h2 {
        font-size: 1.3em; 
        color: #333;
        margin-bottom: 8px;
    }

    .mosaic-card p {
        margin: 4px 0; 
        font-size: 0.9em;
        color: #555;
    }
</style>
