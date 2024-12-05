
<section class="login-area section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content">
                    <h3 style="text-align: center;">Recherchez votre candidature</h3>
                    <!-- Login Form -->
                    <div class="login-form" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                        <?php echo form_open('/candidature/afficherFormulaire'); ?>
                        <?= csrf_field() ?>
                        <div class="form-group" style="width: 100%; max-width: 400px; margin: 10px 0;">
                            <label for="CodeInscription" style="display: block; text-align: left; margin-bottom: 5px;">Code Inscription :</label>
                            <input type="input" name="codeIns" value="<?= set_value('codeIns') ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            <?= validation_show_error('codeIns') ?>
                        </div>
                        <div class="form-group" style="width: 100%; max-width: 400px; margin: 10px 0;">
                            <label for="CodeIdentification" style="display: block; text-align: left; margin-bottom: 5px;">Code Identification :</label>
                            <input type="input" name="codeId" value="<?= set_value('codeId') ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            <?= validation_show_error('codeId') ?>
                        </div>
                        <input type="submit" name="submit" value="Voir candidature" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        </form>
                        
                        <?php
                        if (isset($titre)) {
                        
                        echo $titre; 
                        }
                        
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





