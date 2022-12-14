<!-- Title -->
<div class="page-header">
    <h2><?= t('ThemeRevision Settings') ?></h2>
</div>

<?php if ($this->user->isAdmin()): ?>
    <!-- diff colors -->
    <?php if (!empty($color_diffs)): ?>
    <form method="post" action="<?= $this->url->href('PluginConfigsController', 'dismiss', array('plugin' => 'ThemeRevision')) ?>">
    <fieldset>
        <p class="alert alert-warning"><b><?= t('Notice') ?></b><br><?= t('Some colors have been changed after last upgrading.') ?></p>
        <?php foreach($color_diffs as $paletteName=>$paletteValue):  ?>
        <p style="clear: both;">
            <legend><?= t(ucwords(str_replace("_", " ", $paletteName))) ?></legend>
            <?php foreach($paletteValue as $colorName=>$colorValue):  ?><span style="float: left;margin-right: 2rem;margin-bottom: 1rem;width: 12rem;">
                <?= $colorName ?><br>
                <?php if ($colorValue['old']): ?>
                    <del style="border-left: 1rem solid <?= $colorValue['old'] ?>;padding: 0 .5rem;"><?= $colorValue['old'] ?></del><br>
                <?php endif ?>
                <?php if ($colorValue['new']): ?>
                    <span style="border-left: 1rem solid <?= $colorValue['new'] ?>;padding:  0 .5rem;"><?= $colorValue['new'] ?></span>
                <?php endif ?>
            </span><?php endforeach; ?>
        </p>
        <?php endforeach; ?>
    </fieldset>
    <p><input type="submit" class="btn btn-red" value="<?= t('Dismiss') ?>"></p>
    </form>
    <?php endif ?>

    <!-- Configs -->
    <form method="post" action="<?= $this->url->href('PluginConfigsController', 'save', array('plugin' => 'ThemeRevision')) ?>">
        <?= $this->form->csrf() ?>
        <!-- Color Scheme -->
        <fieldset>
            <legend><?= t('Color Scheme') ?></legend>
            <p><small><?= t('The "user" option will provide an individually controlled panel for users to switch between "Auto", "Light", and "Dark"') ?></small></p>
            <?= $this->form->select('color_scheme', 
                // array('user' => t('User'), 'light' => t('Light'), 'dark' => t('Dark')), 
                $this->helper->configsDataHelper->getCandidatesInTemplate("color_scheme"),
                array('color_scheme' => $configs['color_scheme'])
            ) ?>
        </fieldset>

        <!-- Logo -->
        <fieldset>
            <legend><?= t('Header Logo') ?></legend>
            <p><small><?= t('ThemeRevision utilize the file "favicon.png" in the directory "your_kanboard_root/assets/img" as the header logo, replace it if needed.') ?></small></p>
        </fieldset>

        <!-- Task Color -->
        <fieldset>
            <legend><?= t('Default Task Color') ?></legend>
            <p><small><?= t('Overwrite the default task color for better UI consistency. The option in project settings will be invalidated') ?></small></p>
            <?= $this->form->checkbox('overwrite_default_task_color', 
                t('Overwrite with "task-grey"'), 
                $configs['overwrite_default_task_color'], 
                $configs['overwrite_default_task_color']
            ) ?>
        </fieldset>

        <!-- Icons -->
        <fieldset>
            <legend><?= t('Icons') ?></legend>
            <?= $this->form->checkbox('enable_google_material_icons', 
                t('Replace default icons with "Google Material Symbols"'), 
                $configs['enable_google_material_icons'], 
                $configs['enable_google_material_icons']
            ) ?>
        </fieldset>

        <!-- Google Fonts -->
        <fieldset>
            <legend><i class="fa fa-cloud"></i><a href="https://fonts.google.com/" target="_blank" style="font-weight:bold !important;border-bottom:1px dotted var(--color-greyscale-3);"><?= t('Google Fonts') ?></a></legend>
            <p><small>
                <?= e('Override default fonts with "Google Fonts". <b>Only one font family name</b> supported by Google can be filled in for each category. Note: the font family name of a font may differ from it\'s general name.') ?><br>
                <?= t('If this feature is not working, please check the CSP settings on your server first.') ?> <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy" target="_blank" style="border-bottom:1px dotted var(--color-greyscale-3);""><?= t('More') ?></a><br>
            </small></p>
            <div class="panel" style="border-left:var(--style-border-thk);">
                <label><b><?= t('UI') ?></b></label>
                <p><small><?= t('A font name for Most parts of the system UI. Example: ') ?><i>Noto Sans</i></small></p>
                <input type='text' value="<?= $configs['google_fonts']['ui'] ?>" name="google_fonts[ui]" placeholder="<?= t('Name, case-sensitive') ?>"/>
                <label><b><?= t('Codes') ?></b></label>
                <p><small><?= t('A font name for all code blocks, and statistics in the overview page. Monospaced fonts are recommended. Example: ') ?><i><code>Noto Sans Mono</code></i></small></p>
                <input type='text' value="<?= $configs['google_fonts']['codes'] ?>" name="google_fonts[codes]" placeholder="<?= t('Name, case-sensitive') ?>"/>
            </div>
        </fieldset>

        <!-- Column Header Info -->
        <fieldset>
            <legend><?= t('Column Header Info') ?></legend>
            <p><small><?= t('Display the following statistics in the column header if they exist. Hide all by default. "More Statistics" represents the number of tasks across all swimlanes and the limitation of tasks\' number in the current column.') ?></small></p>
            <div class="info-options" style="display:flex;flex-wrap:wrap;">
                <?php foreach($configs['column_header_info'] as $key=>$value):  ?>
                    <span style="width:16rem;"><?= $this->form->checkbox('column_header_info['.$key.']', 
                        t(ucwords(str_replace("_", " ", $key))), 
                        $value, 
                        $value
                    ) ?></span>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <!-- Board Task Info -->
        <fieldset>
            <legend><?= t('Board Task Info') ?></legend>
            <p><small><?= t('Display the following information in the footer of a task card if it exists. Show all by default.') ?></small></p>
            <div class="info-options" style="display:flex;flex-wrap:wrap;">
                <?php foreach($configs['board_task_info'] as $key=>$value):  ?>
                    <span style="width:16rem;"><?= $this->form->checkbox('board_task_info['.$key.']', 
                        t(ucwords(str_replace("_", " ", $key))), 
                        $value, 
                        $value
                    ) ?></span>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <fieldset>
            <!-- Light Palette -->
            <legend><?= t('Light Palette') ?></legend>
            <p><small><?= t('Check the file "config-default.php" in the plugin directory for more information.') ?></small> <a href="https://github.com/greyaz/ThemeRevision/blob/main/Model/DefaultConfigsModel.php" target="_blank" style="border-bottom:1px dotted var(--color-greyscale-3);"><small><?= t("View on Github") ?></small></a></p>
            <div class="color-palette" style="display:flex;flex-wrap:wrap;">
                <?php foreach($configs['light_palette'] as $key=>$value):  ?>
                    <?= in_array($key, $end_keys['light']) ? '<hr style="width:100%;margin-bottom:1.5rem;">' : ''; ?>
                    <span class="tr-color-picker" style="width:16rem;"><input type='text' value="<?= $value ?>" name="<?= 'light_palette['.$key.']' ?>" /> <?= $key ?></span>
                <?php endforeach; ?>
                <hr style="width:100%;margin-bottom:1rem;">
            </div>
        </fieldset>

        <fieldset>
            <!-- Dark Palette -->
            <legend><?= t('Dark Palette') ?></legend>
            <p><small><?= t('Check the file "config-default.php" in the plugin directory for more information.') ?></small> <a href="https://github.com/greyaz/ThemeRevision/blob/main/Model/DefaultConfigsModel.php" target="_blank" style="border-bottom:1px dotted var(--color-greyscale-3);"><small><?= t("View on Github") ?></small></a></p>
            <div class="color-palette" style="display:flex;flex-wrap:wrap;">
                <?php foreach($configs['dark_palette'] as $key=>$value):  ?>
                    <?= in_array($key, $end_keys['dark']) ? '<hr style="width:100%;margin-bottom:1.5rem;">' : ''; ?>
                    <span class="tr-color-picker" style="width:16rem;"><input type='text' value="<?= $value ?>" name="<?= 'dark_palette['.$key.']' ?>" /> <?= $key ?></span>
                <?php endforeach; ?>
                <hr style="width:100%;margin-bottom:1rem;">
            </div>
        </fieldset>

        <fieldset>
            <!-- Mode -->
            <legend><?= t('Mode') ?></legend>
            <p><small><?= e('Development mode will introduce raw CSS files for easier customization and minify automatically after switching back. <span style="color:var(--color-warning-prim)">Make sure the "Asset" folder in plugin\'s root directory is writable and executable before switching</span>') ?></small></p>
            <?= $this->form->select('mode', 
                //array('production' => t('Production'), 'development' => t('Development')), 
                $this->helper->configsDataHelper->getCandidatesInTemplate("mode"),
                array('mode' => $configs['mode'])
            ) ?>
        </fieldset>
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
<?php else: ?>
    <p class="alert alert-error"><?= t('Access Forbidden') ?></p>
<?php endif ?>
