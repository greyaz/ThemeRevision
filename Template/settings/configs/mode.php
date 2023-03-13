<fieldset>
    <legend><?= t('Mode') ?></legend>
    <p><small><?= e('Development mode will introduce raw CSS files for easier customization and minify automatically after switching back. <span style="color:var(--color-warning-prim)">Make sure the "Asset" folder in plugin\'s root directory is writable and executable before switching</span>') ?></small></p>
    <?= $this->form->select('mode', 
        //array('production' => t('Production'), 'development' => t('Development')), 
        $this->helper->configsDataHelper->getCandidatesInTemplate("mode"),
        array('mode' => $configs['mode'])
    ) ?>
</fieldset>
