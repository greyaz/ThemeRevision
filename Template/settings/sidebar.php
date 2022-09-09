<li <?= $this->app->checkMenuSelection('PluginConfigsController', 'show', 'ThemeRevision') ?>>
    <?= $this->url->link(t('ThemeRevision Settings'), 'PluginConfigsController', 'show', array('plugin' => 'ThemeRevision')) ?>
</li>
