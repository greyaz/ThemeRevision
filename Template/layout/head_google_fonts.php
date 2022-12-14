<?php
    $styles = "";
    $links = "";

    foreach($configs as $key => $value){
        if (!empty(trim($value))){
            $links .= "family=".str_replace(" ", "+", trim($value)).":wght@400;700&";
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
        $styles = ":root{".$styles."}";
    }
?>
<?php if($styles && $links): ?>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?<?= $links ?>display=swap" rel="stylesheet"><style><?= $styles ?></style>
<?php endif ?>
