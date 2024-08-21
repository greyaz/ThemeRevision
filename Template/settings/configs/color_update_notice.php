<?php if (!empty($color_diffs)):  ?>
<form method="post" action="<?= $this->url->href('PluginConfigsController', 'dismiss', array('plugin' => 'ThemeRevision')) ?>">
    <fieldset>
        <p class="alert alert-warning"><b><?= t('Notice') ?></b><br><?= t('Some colors have been changed after last upgrading.') ?></p>
        <?php foreach($color_diffs as $paletteName=>$paletteValue):  ?>
            <p style="clear: both;">
                <legend><?= t(ucwords(str_replace("_", " ", $paletteName))) ?></legend>
                <?php foreach($paletteValue as $colorName=>$colorValue):  ?><span style="float: left;margin-right: 2rem;margin-bottom: 1rem;width: 12rem;">
                    <?= $colorName ?><br>
                    <?php if ($colorValue['old']): ?>
                        <del style="border-left: 1rem solid <?= $colorValue['old'] ?>;padding: 0 .5rem;"><?= $colorValue['old'] ?></del><br>
                    <?php endif ?>
                    <?php if ($colorValue['new']): ?>
                        <span style="border-left: 1rem solid <?= $colorValue['new'] ?>;padding:  0 .5rem;"><?= $colorValue['new'] ?></span>
                    <?php endif ?>
                </span><?php endforeach; ?>
            </p>
        <?php endforeach; ?>
    </fieldset>
    <p><input type="submit" class="btn btn-red" value="<?= t('Dismiss') ?>"></p>
</form>
<?php endif ?>
