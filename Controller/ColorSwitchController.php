<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Core\Base;
use Kanboard\Plugin\ThemeRevision\Model\LightColorModel;
use Kanboard\Plugin\ThemeRevision\Model\DarkColorModel;

class ColorSwitchController extends Base
{
    private $lightFile = 'plugins/ThemeRevision/Asset/light.css';
    private $darkFile = 'plugins/ThemeRevision/Asset/dark.css';
    private $autoColorFile = 'plugins/ThemeRevision/Asset/auto-color.css';

    public function setColor2Dark($plugin){
        $this->container[colorModel] = $this->container->factory(function ($c) {
            return new DarkColorModel($c);
        });

        if(file_exists($this->autoColorFile)){
            unlink($this->autoColorFile);
        }
        $plugin->hook->on('template:layout:css', array('template' => $this->darkFile));
    }

    public function setColor2Light($plugin){
        $this->container[colorModel] = $this->container->factory(function ($c) {
            return new LightColorModel($c);
        });

        if(file_exists($this->autoColorFile)){
            unlink($this->autoColorFile);
        }
        $plugin->hook->on('template:layout:css', array('template' => $this->lightFile));
    }

    public function setColorBySys($plugin){
        $prefer = $_COOKIE["prefers_color_scheme"];

        if ($prefer == "dark"){
            $this->setColor2Dark($plugin);
        }
        else {
            $this->setColor2Light($plugin);
        }
    }
}
