<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;
use Kanboard\Plugin\ThemeRevision\Helper\BaseSwitchHelper;

class ModeSwitchHelper extends BaseSwitchHelper
{
    private $prdCSSFile = 'plugins/ThemeRevision/Asset/main.min.css';
    private $devCSSFiles = array(
        'plugins/ThemeRevision/Asset/dev/css/basics.css',
		'plugins/ThemeRevision/Asset/dev/css/form-components.css',
		'plugins/ThemeRevision/Asset/dev/css/table.css',
		'plugins/ThemeRevision/Asset/dev/css/layout.css',
        'plugins/ThemeRevision/Asset/dev/css/login.css',
		'plugins/ThemeRevision/Asset/dev/css/header.css',
		'plugins/ThemeRevision/Asset/dev/css/plugins.css',
		'plugins/ThemeRevision/Asset/dev/css/switcher-action-filter.css',
		'plugins/ThemeRevision/Asset/dev/css/board.css',
		'plugins/ThemeRevision/Asset/dev/css/task-detail.css',
		'plugins/ThemeRevision/Asset/dev/css/project-overview.css',
		'plugins/ThemeRevision/Asset/dev/css/sidebar.css',
		'plugins/ThemeRevision/Asset/dev/css/table-list.css',
		'plugins/ThemeRevision/Asset/dev/css/board-task-list.css',
		'plugins/ThemeRevision/Asset/dev/css/activity-and-comment.css',
		'plugins/ThemeRevision/Asset/dev/css/modal.css',
		'plugins/ThemeRevision/Asset/dev/css/break-points.css'
    );

    public function productionMode(){
        if(!file_exists($this->prdCSSFile)){
            $file = fopen($this->prdCSSFile, "w");
            fwrite($file, $this->minifyCSS());
            fclose($file);
        }
        $this->getPlugin()->hook->on('template:layout:css', array('template' => $this->prdCSSFile));
    }

    public function developmentMode(){
        if(file_exists($this->prdCSSFile)){
            unlink($this->prdCSSFile);
        }
        foreach ($this->devCSSFiles as $value)
        {
            $this->getPlugin()->hook->on('template:layout:css', array('template' => $value));
        }
    }

    private function getAllCSSContents(){
        $str = '';
        foreach ($this->devCSSFiles as $value)
        {
            $str = $str.file_get_contents($value);
        }
        return $str;
    }

    // Code comes from Rodrigo54. https://gist.github.com/Rodrigo54/93169db48194d470188f
    private function minifyCSS(){
        $input = $this->getAllCSSContents();
        if(trim($input) === "") return $input;

        return preg_replace(
            array(
                // Remove comment(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
                // Remove unused white-space(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
                // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
                '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
                // Replace `:0 0 0 0` with `:0`
                '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
                // Replace `background-position:0` with `background-position:0 0`
                '#(background-position):0(?=[;\}])#si',
                // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
                '#(?<=[\s:,\-])0+\.(\d+)#s',
                // Minify string value
                '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
                '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
                // Minify HEX color code
                '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
                // Replace `(border|outline):none` with `(border|outline):0`
                '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
                // Remove empty selector(s)
                '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
            ),
            array(
                '$1',
                '$1$2$3$4$5$6$7',
                '$1',
                ':0',
                '$1:0 0',
                '.$1',
                '$1$3',
                '$1$2$4$5',
                '$1$2$3',
                '$1:0',
                '$1$2'
            ),
        $input);
    }
}
