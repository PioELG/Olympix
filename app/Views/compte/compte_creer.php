<h2><?php echo $titre; ?></h2>

<?= session()->getFlashdata('error') ?>

<?php
// Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
echo form_open('compte/creer'); ?>
<?= csrf_field() ?>

<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-floating mb-3 mb-md-0">
            <input class="form-control" id="inputNom" type="text" name="nom" placeholder="Nom" value="<?= set_value('nom') ?>">
            <label for="inputNom">Nom</label>
        </div>
        <?= validation_show_error('nom') ?>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3 mb-md-0">
            <input class="form-control" id="inputPrenom" type="text" name="prenom" placeholder="Prénom" value="<?= set_value('prenom') ?>">
            <label for="inputPrenom">Prénom</label>
        </div>
        <?= validation_show_error('prenom') ?>
    </div>
</div>

<div class="form-floating mb-3">
    <input class="form-control" id="inputPseudo" type="text" name="pseudo" placeholder="Pseudo" value="<?= set_value('pseudo') ?>">
    <label for="inputPseudo">Pseudo</label>
</div>
<?= validation_show_error('pseudo') ?>

<div class="form-floating mb-3">
    <input class="form-control" id="inputMdp" type="password" name="mdp" placeholder="Mot de passe">
    <label for="inputMdp">Mot de passe</label>
</div>
<?= validation_show_error('mdp') ?>

<div class="form-floating mb-3">
    <select class="form-select" id="selectRole" name="role">
        <option value="admin" <?= set_select('role', 'admin') ?>>Admin</option>
        <option value="jury" <?= set_select('role', 'jury') ?>>Jury</option>
    </select>
    <label for="selectRole">Choisissez un rôle</label>
</div>
<?= validation_show_error('role') ?>

<div class="mt-4 mb-0">
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary" type="submit" name="submit">Créer un nouveau compte</button>
        <a class="btn btn-secondary" href="javascript:history.go(-1)">Annuler</a>
    </div>
</div>

</form>
