<?php
namespace Kanboard\Plugin\ThemeRevision\Helper;

class GoogleFontsHelper
{
    public static function getCssStyles(array $configs){
        $varStr = "";
        $return = "";

        foreach($configs as $key => $value){
            if (!empty(trim($value))){
                $return .= "family=".str_replace(" ", "+", trim($value)).":wght@400;700&";
                switch ($key){
                    case "ui":
                        $varStr.= "--style-fontfamily:'".trim($value)."',sans-serif !important;";
                        break;
                    case "codes":
                        $varStr.= "--style-fontfamily-code:'".trim($value)."',monospace !important;";
                        break;
                }
            }
        }
        if (!empty($varStr)){
            $return = "@import url('https://fonts.googleapis.com/css2?".$return."display=swap');";
            $return .= ":root{".$varStr."}";
        }

        return $return;
    }
}

