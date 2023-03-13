<?= $this->asset->css('plugins/ThemeRevision/Asset/spectrum/min.css') ?>
<?= $this->asset->js('plugins/ThemeRevision/Asset/spectrum/min.js') ?>

<!-- Title -->
<div class="page-header">
    <h2><?= t('ThemeRevision Settings') ?></h2>
</div>

<?php if ($this->user->isAdmin()): ?>
    <!-- diff colors -->
    <?php if (!empty($color_diffs)): ?>
        <?= $this->render('ThemeRevision:settings/configs/color_update_notice', array('color_difffs' => $color_diffs)) ?>
    <?php endif ?>

    <!-- Configs -->
    <form method="post" action="<?= $this->url->href('PluginConfigsController', 'save', array('plugin' => 'ThemeRevision')) ?>">
        <?= $this->form->csrf() ?>
        <!-- Color Scheme -->
        <?= $this->render('ThemeRevision:settings/configs/color_scheme', array('configs' => $configs)) ?>

        <!-- Logo -->
        <?= $this->render('ThemeRevision:settings/configs/logo') ?>

        <!-- Task Color -->
        <?= $this->render('ThemeRevision:settings/configs/task_color', array('configs' => $configs)) ?>

        <!-- Icons -->
        <?= $this->render('ThemeRevision:settings/configs/icons', array('configs' => $configs)) ?>
        
        <!-- Google Fonts -->
        <?= $this->render('ThemeRevision:settings/configs/google_fonts', array('configs' => $configs)) ?>

        <!-- Column Header Info -->
        <?= $this->render('ThemeRevision:settings/configs/column_header_info', array('configs' => $configs)) ?>

        <!-- Board Task Info -->
        <?= $this->render('ThemeRevision:settings/configs/board_task_info', array('configs' => $configs)) ?>

        <!-- Corner Radius -->
        <?= $this->render('ThemeRevision:settings/configs/corner_radius', array('configs' => $configs)) ?>
        
        <!-- Light Palette -->
        <?= $this->render('ThemeRevision:settings/configs/palette', array('configs' => $configs, 'end_keys' => $end_keys, 'color' => 'light')) ?>

        <!-- Dark Palette -->
        <?= $this->render('ThemeRevision:settings/configs/palette', array('configs' => $configs, 'end_keys' => $end_keys, 'color' => 'dark')) ?>

        <!-- Mode -->
        <?= $this->render('ThemeRevision:settings/configs/mode', array('configs' => $configs)) ?>
        
        <!-- Save -->
        <p><input type="submit" class="btn btn-blue" value="<?= t('Save') ?>"></p>
    </form>
    
    <!-- Reset -->
    <form method="post" action="<?= $this->url->href('PluginConfigsController', 'reset', array('plugin' => 'ThemeRevision')) ?>">
        <fieldset>
            <legend><?= t('Reset Configs') ?></legend>
            <input type="submit" class="btn btn-red" value="<?= t('Reset') ?>"> 
        </fieldset>
    </form>

    <!-- init color pickers -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event){
            if ($){
                $(".tr-color-picker > input[type='text']").spectrum({
                    preferredFormat: "rgb",
                    showInput: true,
                    showAlpha: true
                });
                $(".overwrite-checkbox").change(function(event) {
                    $(event.target).val($(event.target).is(':checked')) 
                });
            }
        });
    </script>
<?php else: ?>
    <p class="alert alert-error"><?= t('Access Forbidden') ?></p>
<?php endif ?>
