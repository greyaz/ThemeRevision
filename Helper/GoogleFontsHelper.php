<?php
namespace Kanboard\Plugin\ThemeRevision\Helper;

class GoogleFontsHelper
{
    public static function getCodes(array $configs){
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
            
            return array(
                "styles" => $styles,
                "links" => $links
            );
        }
        else{
            return "";
        }
    }
}

