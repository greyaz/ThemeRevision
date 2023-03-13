<fieldset>
    <legend><i class="fa fa-cloud"></i><a href="https://fonts.google.com/" target="_blank" style="font-weight:bold !important;border-bottom:1px dotted var(--color-greyscale-3);"><?= t('Google Fonts') ?></a></legend>
    <p><small>
        <?= e('Override default fonts with "Google Fonts". <b>Only one font family name</b> supported by Google can be filled in for each category. Note: the font family name of a font may differ from it\'s general name.') ?><br>
        <?= t('If this feature is not working, please check the CSP settings on your server first.') ?> <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy" target="_blank" style="border-bottom:1px dotted var(--color-greyscale-3);""><?= t('More') ?></a><br>
    </small></p>
    <div class="panel" style="border-left:var(--style-border-thk);">
        <label><b><?= t('UI') ?></b></label>
        <p><small><?= t('A font name for Most parts of the system UI. Example: ') ?><i>Noto Sans</i></small></p>
        <input type='text' value="<?= $configs['google_fonts']['ui'] ?>" name="google_fonts[ui]" placeholder="<?= t('Name, case-sensitive') ?>"/>
        <label><b><?= t('Codes') ?></b></label>
        <p><small><?= t('A font name for all code blocks, and statistics in the overview page. Monospaced fonts are recommended. Example: ') ?><i><code>Noto Sans Mono</code></i></small></p>
        <input type='text' value="<?= $configs['google_fonts']['codes'] ?>" name="google_fonts[codes]" placeholder="<?= t('Name, case-sensitive') ?>"/>
    </div>
</fieldset>
