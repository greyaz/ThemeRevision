<fieldset>
    <legend><?= t('Icons') ?></legend>
    <?= $this->form->checkbox('enable_google_material_icons', 
        t('Replace default icons with "Google Material Symbols"'), 
        $configs['enable_google_material_icons'], 
        $configs['enable_google_material_icons']
    ) ?>
</fieldset>
