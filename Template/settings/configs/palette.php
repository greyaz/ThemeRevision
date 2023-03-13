<fieldset>
    <legend><?= t(ucfirst($color).' Palette') ?></legend>
    <p><small><?= t('Check the file "config-default.php" in the plugin directory for more information.') ?></small> <a href="https://github.com/greyaz/ThemeRevision/blob/main/Model/DefaultConfigsModel.php" target="_blank" style="border-bottom:1px dotted var(--color-greyscale-3);"><small><?= t("View on Github") ?></small></a></p>
    <div class="color-palette" style="display:flex;flex-wrap:wrap;">
        <?php foreach($configs[$color.'_palette'] as $key=>$value):  ?>
            <?= in_array($key, $end_keys[$color]) ? '<hr style="width:100%;">' : ''; ?>
            <span class="tr-color-picker" style="width:16rem;"><input type='text' value="<?= $value ?>" name="<?= $color.'_palette['.$key.']' ?>" /> <?= $key ?></span>
        <?php endforeach; ?>
        <hr style="width:100%;margin-bottom:1rem;">
    </div>
</fieldset>
