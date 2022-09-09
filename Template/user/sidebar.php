<?php if ($this->user->isCurrentUser($user['id'])): ?>
<li <?= $this->app->checkMenuSelection('UserSettingsController', 'show', 'ThemeRevision') ?>>
    <?= $this->url->link(t('Theme Mode'), 'UserSettingsController', 'show', array('plugin' => 'ThemeRevision', 'user_id' => $user['id'])) ?>
</li>
<?php endif ?>
