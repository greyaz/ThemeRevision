<?php
    $styles = "";
    $fonts = "@import url('https://fonts.googleapis.com/css2?";

    foreach($configs as $key => $value){
        if (!empty(trim($value))){
            $fonts .= "family=".str_replace(" ", "+", trim($value)).":wght@400;700&";
            switch ($key){
                case "ui":
                    $styles.= "--style-fontfamily:'".trim($value)."',sans-serif !important;";
                    break;
                case "codes":
                    $styles.= "--style-fontfamily-code:'".trim($value)."',monospace !important;";
                    break;
            }
        }
    }
    if (!empty($styles)){
        $styles = $fonts."display=swap');".":root{".$styles."}";
    }
?>
<?php if($styles): ?>
    <style><?= $styles ?></style>
<?php endif ?>
