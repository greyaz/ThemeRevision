<!-- Title -->
<div class="page-header">
    <h2><?= t('ThemeRevision Settings') ?></h2>
</div>

<?php if ($this->user->isAdmin()): ?>
    <!-- Notice -->
    <span <?= !$data_in_db ? 'style="display:block;"' : 'style="display:none;"'; ?>>
        <p class="alert alert-warning">
            <b><?= t('Notice') ?></b><br>
            <?= t('Editing the theme settings via UI will disable your config file ("config-default.php" or "config.php") in the plugin directory. But you can still re-enable it later.') ?>
        </p>
        <button id="continue-btn" class="btn btn-blue"><?= t('Continue') ?></button>
    </span>
    <!-- Configs -->
    <span id="tr-settings" <?= !$data_in_db ? 'style="display:none;"' : ''; ?>>
        <form method="post" action="<?= $this->url->href('PluginConfigsController', 'save', array('plugin' => 'ThemeRevision')) ?>">
            <?= $this->form->csrf() ?>
            <fieldset>
                <!-- Mode -->
                <legend><?= t('Mode') ?></legend>
                <p><small><?= e('Development mode will introduce raw CSS files for easier customization and minify automatically after switching back. <span style="color:var(--color-warning-prim)">Make sure the "Asset" folder in plugin\'s root directory is writable and executable before switching</span>') ?></small></p>
                <?= $this->form->select('mode', 
                    array('production' => t('Production'), 'development' => t('Development')), 
                    array('mode' => $configs['mode'])
                ) ?>
                <!-- Color Scheme -->
                <legend><?= t('Color Scheme') ?></legend>
                <p><small><?= t('The "user" option will provide an individually controlled panel for users to switch between "Auto", "Light", and "Dark"') ?></small></p>
                <?= $this->form->select('color_scheme', 
                    array('user' => t('User'), 'light' => t('Light'), 'dark' => t('Dark')), 
                    array('color_scheme' => $configs['color_scheme'])
                ) ?>
                <!-- Task Color -->
                <legend><?= t('Default Task Color') ?></legend>
                <p><small><?= t('Overwrite the default task color for better UI consistency. The option in project settings will be invalidated') ?></small></p>
                <?= $this->form->checkbox('overwrite_default_task_color', 
                    t('Overwrite with "task-grey"'), 
                    $configs['overwrite_default_task_color'], 
                    $configs['overwrite_default_task_color']
                ) ?>
                <!-- Icons -->
                <legend><?= t('Icons') ?></legend>
                <?= $this->form->checkbox('enable_google_material_icons', 
                    t('Replace default icons with "Google Material Symbols"'), 
                    $configs['enable_google_material_icons'], 
                    $configs['enable_google_material_icons']
                ) ?>
                <!-- Google Fonts -->
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

            <fieldset>
                <!-- Light Palette -->
                <legend><?= t('Light Palette') ?></legend>
                <p><small><?= t('Check the file "config-default.php" in the plugin directory for more information.') ?></small> <a href="https://github.com/greyaz/ThemeRevision/blob/main/config-default.php" target="_blank" style="border-bottom:1px dotted var(--color-greyscale-3);"><small><?= t("View on Github") ?></small></a></p>
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
                <p><small><?= t('Check the file "config-default.php" in the plugin directory for more information.') ?></small> <a href="https://github.com/greyaz/ThemeRevision/blob/main/config-default.php" target="_blank" style="border-bottom:1px dotted var(--color-greyscale-3);"><small><?= t("View on Github") ?></small></a></p>
                <div class="color-palette" style="display:flex;flex-wrap:wrap;">
                    <?php foreach($configs['dark_palette'] as $key=>$value):  ?>
                        <?= in_array($key, $end_keys['dark']) ? '<hr style="width:100%;margin-bottom:1.5rem;">' : ''; ?>
                        <span class="tr-color-picker" style="width:16rem;"><input type='text' value="<?= $value ?>" name="<?= 'dark_palette['.$key.']' ?>" /> <?= $key ?></span>
                    <?php endforeach; ?>
                    <hr style="width:100%;margin-bottom:1rem;">
                </div>
            </fieldset>
            <!-- Save -->
            <input type="submit" class="btn btn-blue" value="<?= t('Save') ?>"> 
        </form>
        <!-- Export -->
        <form method="post" action="<?= $this->url->href('PluginConfigsController', 'export', array('plugin' => 'ThemeRevision')) ?>">
            <fieldset>
                <legend><?= t('Export Configs') ?></legend>
                <p><small><?= t('Export your current configs as a config file, which can help you compare the difference (between your configs and the new default config file) after upgrading, or replacing the one on the server.') ?></small></p>
                <input type="submit" class="btn" value="<?= t('Export') ?>"> 
            </fieldset>
        </form>
        <!-- Reset -->
        <form method="post" action="<?= $this->url->href('PluginConfigsController', 'reset', array('plugin' => 'ThemeRevision')) ?>">
            <fieldset>
                <legend><?= t('Reset Configs') ?></legend>
                <p><small><?= t('Clear all configs stored in the database and reuse your config file on the server.') ?></small></p>
                <input type="submit" class="btn btn-red" value="<?= t('Reset') ?>"> 
            </fieldset>
        </form>
    </span>

    <script  defer type="text/javascript" src="/plugins/ThemeRevision/Asset/settings.min.js"></script>
<?php else: ?>
    <p class="alert alert-error"><?= t('Access Forbidden') ?></p>
<?php endif ?>
