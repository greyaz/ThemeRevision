<fieldset>
    <legend><?= t('Corner Radius') ?></legend>
    <p><small><?= t('The corner radius for elements on the page. Any unit allowed by CSS is acceptable: px, em, rem, %%, ...') ?></small></p>
    <input type='text' value="<?= $configs['corner_radius'] ?>" name="corner_radius" placeholder="<?= 'px, em, rem, %, ...' ?>"/>
</fieldset>
