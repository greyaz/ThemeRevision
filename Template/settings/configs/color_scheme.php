<fieldset>
    <legend><?= t('Color Scheme') ?></legend>
    <p><small><?= t('The "user" option will provide an individually controlled panel for users to switch between "Auto", "Light", and "Dark"') ?></small></p>
    <?= $this->form->select('color_scheme', 
        // array('user' => t('User'), 'light' => t('Light'), 'dark' => t('Dark')), 
        $this->helper->configsDataHelper->getCandidatesInTemplate("color_scheme"),
        array('color_scheme' => $configs['color_scheme'])
    ) ?>
</fieldset>
