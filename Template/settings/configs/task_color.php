<fieldset>
    <legend><?= t('Default Task Color') ?></legend>
    <p><small><?= t('Overwrite the default task color for better UI consistency. The option in project settings will be invalidated') ?></small></p>
    <?= $this->form->checkbox('overwrite_default_task_color', 
        t('Overwrite with "task-grey"'), 
        $configs['overwrite_default_task_color'], 
        $configs['overwrite_default_task_color']
    ) ?>
</fieldset>
