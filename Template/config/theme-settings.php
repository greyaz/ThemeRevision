<div class="page-header">
    <h2><?= t('Theme Settings') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('ThemeSettingsController', 'save', array('plugin' => 'ThemeRevision', 'user_id' => $user['id'])) ?>">
        <legend><?= t('Theme color') ?></legend>
        <select name="color">
            <!-- auto (default) -->
            <?php if ($colorScheme == 'auto'): ?>
                <option value="auto" selected="selected"><?= t('Auto') ?></option>
            <?php else: ?>
                 <option value="auto"><?= t('Auto') ?></option>
            <?php endif ?>
            <!-- light -->
            <?php if ($colorScheme == 'light'): ?>
                <option value="light" selected="selected"><?= t('Light') ?></option>
            <?php else: ?>
                 <option value="light"><?= t('Light') ?></option>
            <?php endif ?>
            <!-- dark -->
            <?php if ($colorScheme == 'dark'): ?>
                <option value="dark" selected="selected"><?= t('Dark') ?></option>
            <?php else: ?>
                 <option value="dark"><?= t('Dark') ?></option>
            <?php endif; ?>
        </select>
    <input type="submit" class="btn btn-blue" value="<?= t('Save') ?>">
</form>
<p class="alert alert-info"><?= t('The "auto" option switches the theme automatically by your system\'s setting.') ?></p>

