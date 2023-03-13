<fieldset>
    <legend><?= t('Column Header Info') ?></legend>
    <p><small><?= t('Display the following statistics in the column header if they exist. Hide all by default. "More Statistics" represents the number of tasks across all swimlanes and the limitation of tasks\' number in the current column.') ?></small></p>
    <div class="info-options" style="display:flex;flex-wrap:wrap;">
        <?php foreach($configs['column_header_info'] as $key=>$value):  ?>
            <span style="width:16rem;"><?= $this->form->checkbox('column_header_info['.$key.']', 
                t(ucwords(str_replace("_", " ", $key))), 
                $value, 
                $value
            ) ?></span>
        <?php endforeach; ?>
    </div>
</fieldset>
