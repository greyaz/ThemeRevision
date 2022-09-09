<div class="page-header">
    <h2><?= t('Theme Mode') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('UserSettingsController', 'save', array('plugin' => 'ThemeRevision', 'user_id' => $user['id'])) ?>">
    <?= $this->form->csrf() ?>
    <fieldset>
        <label><?= t('Theme Color') ?></label>
        <select name="color" title="<?= t('Theme Color') ?>" <?= $this->user->isCurrentUser($user['id']) ? '' : 'disabled="disabled"'; ?>>
            <option value="auto" <?= $colorScheme=='auto'?'selected="selected"':''; ?>><?= t('Auto') ?></option>
            <option value="light" <?= $colorScheme=='light'?'selected="selected"':''; ?>><?= t('Light') ?></option>
            <option value="dark" <?= $colorScheme=='dark'?'selected="selected"':''; ?>><?= t('Dark') ?></option>
        </select>
        <?php if ($this->user->isCurrentUser($user['id'])): ?>
            <input type="submit" class="btn btn-blue" value="<?= t('Save') ?>">
        <?php endif ?>
    </fieldset>
</form>
<p class="alert alert-info"><?= t('The "auto" option switches the theme automatically by your operating system\'s setting.') ?></p>


