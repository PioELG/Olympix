<h2><?php echo $titre; ?></h2>

<?= session()->getFlashdata('error') ?>

<?php
// Création d’un formulaire qui pointe vers l’URL de base + /concours/creer
echo form_open('concours/creer'); ?>
<?= csrf_field() ?>

<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-floating mb-3 mb-md-0">
            <input class="form-control" id="inputNomConcours" type="text" name="nomConcours" placeholder="Nom du Concours" value="<?= set_value('nomConcours') ?>">
            <label for="inputNomConcours">Nom du Concours</label>
        </div>
        <?= validation_show_error('nomConcours') ?>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3 mb-md-0">
            <input class="form-control" id="inputEdition" type="text" name="edition" placeholder="Édition" value="<?= set_value('edition') ?>">
            <label for="inputEdition">Édition</label>
        </div>
        <?= validation_show_error('edition') ?>
    </div>
</div>

<div class="form-floating mb-3">
    <input class="form-control" id="inputDateDebut" type="date" name="dateDebut" placeholder="Date de début" min="<?= date('Y-m-d') ?>" value="<?= set_value('dateDebut') ?>">
    <label for="inputDateDebut">Date de début</label>
</div>
<?= validation_show_error('dateDebut') ?>

<div class="row mb-3">
    <div class="col-md-4">
        <div class="form-floating mb-3 mb-md-0">
            <input class="form-control" id="inputNbCand" type="number" name="nbCand" placeholder="Nombre de jours de candidature" min="1" value="<?= set_value('nbCand') ?>">
            <label for="inputNbCand">Nombre de jours de candidature</label>
        </div>
        <?= validation_show_error('nbCand') ?>
    </div>
    <div class="col-md-4">
        <div class="form-floating mb-3 mb-md-0">
            <input class="form-control" id="inputNbPre" type="number" name="nbPre" placeholder="Nombre de jours de présélection" min="1" value="<?= set_value('nbPre') ?>">
            <label for="inputNbPre">Nombre de jours de présélection</label>
        </div>
        <?= validation_show_error('nbPre') ?>
    </div>
    <div class="col-md-4">
        <div class="form-floating mb-3 mb-md-0">
            <input class="form-control" id="inputNbSelect" type="number" name="nbSelect" placeholder="Nombre de jours de sélection" min="1" value="<?= set_value('nbSelect') ?>">
            <label for="inputNbSelect">Nombre de jours de sélection</label>
        </div>
        <?= validation_show_error('nbSelect') ?>
    </div>
</div>

<div class="mt-4 mb-0">
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary" type="submit" name="submit">Créer un nouveau concours</button>
        <a class="btn btn-secondary" href="javascript:history.go(-1)">Annuler</a>
    </div>
</div>

</form>
