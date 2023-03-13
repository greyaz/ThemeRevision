<fieldset>
    <legend><?= t('Board Task Info') ?></legend>
    <p><small><?= t('Display the following information in the footer of a task card if it exists. Show all by default.') ?></small></p>
    <div class="info-options" style="display:flex;flex-wrap:wrap;border-left:var(--style-border-thk);padding-left:1.5rem;">
        <?php foreach($configs['board_task_info'] as $key=>$value):  ?>
            <span style="width:16rem;"><?= $this->form->checkbox('board_task_info['.$key.']', 
                t(ucwords(str_replace("_", " ", $key))), 
                $value, 
                $value
            ) ?></span>
        <?php endforeach; ?>
    </div>
    <div class="panel" style="border-left:var(--style-border-thk);">
        <label><b><?= t('Default Opacity')  ?></b></label>
        <p><small><?= t('The default opacity of the above information before hovering. You can hide the footer space by setting the opacity to 0%%.') ?></small></p>
        <input type="range" name="task_footer_opacity" min="0" max="1" step="0.01" value="<?= $configs['task_footer_opacity'] ?>" oninput="this.nextElementSibling.value = parseInt(this.value*100)">
        <output><?= $configs['task_footer_opacity']*100 ?></output>%
    </div>
</fieldset>
