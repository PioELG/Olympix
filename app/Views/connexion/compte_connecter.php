<section class="login-area section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content" style="text-align: center;">
                    <h2 style="margin-bottom: 20px;"><?php echo $titre; ?></h2>
                    <?= session()->getFlashdata('error') ?>
                    <!-- Login Form -->
                    <div class="login-form" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <?php echo form_open('/compte/connecter'); ?>
                        <?= csrf_field() ?>
                        <div class="form-group" style="width: 100%; max-width: 400px; margin: 10px 0;">
                            <label for="pseudo" style="display: block; text-align: left; margin-bottom: 5px;">Pseudo :</label>
                            <input type="input" name="pseudo" value="<?= set_value('pseudo') ?>" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            <?= validation_show_error('pseudo') ?>
                        </div>
                        <div class="form-group" style="width: 100%; max-width: 400px; margin: 10px 0;">
                            <label for="mdp" style="display: block; text-align: left; margin-bottom: 5px;">Mot de passe :</label>
                            <input type="password" name="mdp" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            <?= validation_show_error('mdp') ?>
                        </div>
                        <input type="submit" name="submit" value="Se connecter" 
                               style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
