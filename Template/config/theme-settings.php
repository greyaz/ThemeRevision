<div class="page-header">
    <h2><?= t('Theme Settings') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('ThemeSettingsController', 'save', array('plugin' => 'ThemeRevision', 'user_id' => $user['id'])) ?>">
        <legend><?= t('Theme color') ?></legend>
        <select name="color">
            <option value="auto" <?= $colorScheme=='auto'?'selected="selected"':''; ?>><?= t('Auto') ?></option>
            <option value="light" <?= $colorScheme=='light'?'selected="selected"':''; ?>><?= t('Light') ?></option>
            <option value="dark" <?= $colorScheme=='dark'?'selected="selected"':''; ?>><?= t('Dark') ?></option>
        </select>
    <input type="submit" class="btn btn-blue" value="<?= t('Save') ?>">
</form>
<p class="alert alert-info"><?= t('The "auto" option switches the theme automatically by your system\'s setting.') ?></p>

