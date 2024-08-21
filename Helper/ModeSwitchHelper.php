<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;
use Kanboard\Plugin\ThemeRevision\Helper\BaseHelper;
use MatthiasMullie\Minify;

class ModeSwitchHelper extends BaseHelper
{
    private $prdCSSFile = '/Asset/main.min.css';
    private $devCSSFiles = array(
        '/Asset/dev/css/basics.css',
        '/Asset/dev/css/form-components.css',
        '/Asset/dev/css/table.css',
        '/Asset/dev/css/layout.css',
        '/Asset/dev/css/login.css',
        '/Asset/dev/css/header.css',
        '/Asset/dev/css/plugins.css',
        '/Asset/dev/css/switcher-action-filter.css',
        '/Asset/dev/css/board.css',
        '/Asset/dev/css/task-detail.css',
        '/Asset/dev/css/project-overview.css',
        '/Asset/dev/css/sidebar.css',
        '/Asset/dev/css/table-list.css',
        '/Asset/dev/css/board-task-list.css',
        '/Asset/dev/css/activity-and-comment.css',
        '/Asset/dev/css/modal.css',
        '/Asset/dev/css/markdown.css',
        '/Asset/dev/css/other.css',
        '/Asset/dev/css/break-points.css'
    );

    public function productionMode(){
        $prdCSSFile = $this->getPluginPath().$this->prdCSSFile;
		
        if(!file_exists($prdCSSFile)){
            $file = fopen($prdCSSFile, "w");
            fwrite($file, $this->minifyCSS());
            fclose($file);
        }
        $this->getPlugin()->hook->on('template:layout:css', array('template' => 'plugins/ThemeRevision'.$this->prdCSSFile));
    }

    public function developmentMode(){
        $prdCSSFile = $this->getPluginPath().$this->prdCSSFile;

        if(file_exists($prdCSSFile)){
            unlink($prdCSSFile);
        }
        foreach ($this->devCSSFiles as $value)
        {
            $this->getPlugin()->hook->on('template:layout:css', array('template' => 'plugins/ThemeRevision'.$value));
        }
    }

    private function getPluginPath(){
    	$arr = explode("/", __DIR__);
    	$arr = array_slice($arr, 0, -1);
    	return implode("/", $arr);
    }

    private function getAllCSSContents(){
        $str = '';
        foreach ($this->devCSSFiles as $value)
        {
            $str = $str.file_get_contents($this->getPluginPath().$value);
        }
        return $str;
    }

    private function minifyCSS(){
        $css = $this->getAllCSSContents();
        $minifier = new Minify\CSS();
        $minifier->add($css);
        return $minifier->minify();
    }
}
