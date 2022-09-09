<div class="page-header">
    <h2><?= t('ThemeRevision Settings') ?></h2>
</div>
<?php if ($this->user->isAdmin()): ?>
    <p class="alert alert-warning" <?= !$data_in_db ? 'style="display:block;"' : 'style="display:none;"'; ?>>
        <b><?= t('Warning:') ?></b><br>
        <?= t('Editing the theme settings via UI will disable your config file ("config-default.php" or "config.php") in the plugin directory.') ?><br>
        <br>
        <a id="continue-btn" href="javascript:void(0)"><?= t('Continue') ?></a>
    </p>

    <span id="tr-settings" <?= !$data_in_db ? 'style="display:none;"' : ''; ?>>
    <p class="alert alert-info"><?= t('Check the file "config-default.php" in the plugin directory for more information.') ?> <a href="https://github.com/greyaz/ThemeRevision/blob/main/config-default.php" target="_blank">View on Github</a></p>

    <form method="post" action="<?= $this->url->href('PluginConfigsController', 'save', array('plugin' => 'ThemeRevision')) ?>">
        <?= $this->form->csrf() ?>
        <fieldset>
            <legend><?= t('Basic Settings') ?></legend>

            <label><?= t('Mode') ?></label>
            <?= $this->form->select('mode', 
                array('production' => t('Production'), 'development' => t('Development')), 
                array('mode' => $configs['mode'])
            ) ?>

            <label><?= t('Color Scheme') ?></label>
            <?= $this->form->select('color_scheme', 
                array('user' => t('User'), 'light' => t('Light'), 'dark' => t('Dark')), 
                array('color_scheme' => $configs['color_scheme'])
            ) ?>
            
            <label><?= t('Default Task Color') ?></label>
            <?= $this->form->checkbox('overwrite_default_task_color', 
                t('Overwrite with "task-grey", the option in project settings will be invalidated.'), 
                $configs['overwrite_default_task_color'] ? "true" : "false", 
                $configs['overwrite_default_task_color'],
                "overwrite-checkbox"
            ) ?>
        </fieldset>

        <fieldset>
            <legend><?= t('Light Palette') ?></legend>
            <div class="color-palette" style="display:flex;flex-wrap:wrap;">
                <?php foreach($configs['light_palette'] as $key=>$value):  ?>
                    <?= in_array($key, $end_keys['light']) ? '<hr style="width:100%;margin-bottom:1.5rem;">' : ''; ?>
                    <span class="tr-color-picker" style="width:16rem;"><input type='text' value="<?= $value ?>" name="<?= 'light_palette['.$key.']' ?>" /> <?= $key ?></span>
                <?php endforeach; ?>
                <hr style="width:100%;margin-bottom:1rem;">
            </div>
        </fieldset>

        <fieldset>
            <legend><?= t('Dark Palette') ?></legend>
            <div class="color-palette" style="display:flex;flex-wrap:wrap;">
                <?php foreach($configs['dark_palette'] as $key=>$value):  ?>
                    <?= in_array($key, $end_keys['dark']) ? '<hr style="width:100%;margin-bottom:1.5rem;">' : ''; ?>
                    <span class="tr-color-picker" style="width:16rem;"><input type='text' value="<?= $value ?>" name="<?= 'dark_palette['.$key.']' ?>" /> <?= $key ?></span>
                <?php endforeach; ?>
                <hr style="width:100%;margin-bottom:1rem;">
            </div>
        </fieldset>

        <input type="submit" class="btn btn-blue" value="<?= t('Save') ?>"> 
        
    </form>

    <form method="post" action="<?= $this->url->href('PluginConfigsController', 'reset', array('plugin' => 'ThemeRevision')) ?>">
        <fieldset>
            <legend><?= t('Reset Configs') ?></legend>
            <p><?= t('Clear all the configs stored in the database and reuse your config file on the server.') ?></p>
            <input type="submit" class="btn btn-red" value="<?= t('Reset') ?>"> 
        </fieldset>
    </form>
    </span>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', (event) => {
            $(".tr-color-picker > input[type='text']").spectrum({
                preferredFormat: "rgb",
                showInput: true,
                showAlpha: true
            });

            $(".overwrite-checkbox").change(function(event) {
                $(event.target).val($(event.target).is(':checked')) 
            });

            $("#continue-btn").click((event) => {
                $("#continue-btn").parent().hide();
                $("#tr-settings").show();
            });
        });
    </script>
<?php else: ?>
    <p class="alert alert-error"><?= t('Access Forbidden') ?></p>
<?php endif ?>
