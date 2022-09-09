<?php
namespace Kanboard\Plugin\ThemeRevision\Helper;

class ConfigsConvertHelper
{
    public static function toDBFormat(array $config){
        $return = (object)[];
        foreach($config as $key => $value){
            $return->{strtr($key, " ", "_")} = $value;
        }
        return (array) $return;
    }

    public static function toCFFormat(array $config){
        $return = (object)[];
        foreach($config as $key => $value){
            $return->{strtr($key, "_", " ")} = $value;
        }
        return (array) $return;
    }
}
