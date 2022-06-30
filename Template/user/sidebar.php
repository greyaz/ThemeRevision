<li <?= $this->app->checkMenuSelection('ThemeSettingsController', 'show', 'ThemeRevision') ?>>
    <?= $this->url->link(t('Theme Settings'), 'ThemeSettingsController', 'show', array('plugin' => 'ThemeRevision')) ?>
</li>
