<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Core\Base;

class ModeSwitchController extends Base
{
    private $prdFile = 'plugins/ThemeRevision/Asset/revision.css';
    private $dveFiles = array(
        'plugins/ThemeRevision/Asset/dev/basics.css',
		'plugins/ThemeRevision/Asset/dev/form-components.css',
		'plugins/ThemeRevision/Asset/dev/table.css',
		'plugins/ThemeRevision/Asset/dev/layout.css',
		'plugins/ThemeRevision/Asset/dev/header.css',
		'plugins/ThemeRevision/Asset/dev/plugins.css',
		'plugins/ThemeRevision/Asset/dev/switcher-action-filter.css',
		'plugins/ThemeRevision/Asset/dev/board.css',
		'plugins/ThemeRevision/Asset/dev/task-detail.css',
		'plugins/ThemeRevision/Asset/dev/project-overview.css',
		'plugins/ThemeRevision/Asset/dev/sidebar.css',
		'plugins/ThemeRevision/Asset/dev/table-list.css',
		'plugins/ThemeRevision/Asset/dev/board-task-list.css',
		'plugins/ThemeRevision/Asset/dev/activity-and-comment.css',
		'plugins/ThemeRevision/Asset/dev/modal.css',
		'plugins/ThemeRevision/Asset/dev/break-points.css'
    );

    public function productionMode($plugin){
        if(!file_exists($this->prdFile)){
            $file = fopen($this->prdFile, "w");
            fwrite($file, $this->minifyCSS());
            fclose($file);
        }
        $plugin->hook->on('template:layout:css', array('template' => $this->prdFile));
    }

    public function developmentMode($plugin){
        if(file_exists($this->prdFile)){
            unlink($this->prdFile);
        }
        foreach ($this->dveFiles as $value)
        {
            $plugin->hook->on('template:layout:css', array('template' => $value));
        }
    }

    private function getAllContents(){
        $str = '';
        foreach ($this->dveFiles as $value)
        {
            $str = $str.file_get_contents($value);
        }
        return $str;
    }

    private function minifyCSS(){
        $input = $this->getAllContents();
        // Code comes from Rodrigo54. https://gist.github.com/Rodrigo54/93169db48194d470188f
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
