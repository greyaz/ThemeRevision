<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;
use Kanboard\Core\Base;
use Kanboard\Plugin\ThemeRevision\Plugin;
use Kanboard\Plugin\ThemeRevision\Model\LightColorModel;
use Kanboard\Plugin\ThemeRevision\Model\DarkColorModel;

class ColorSwitchHelper extends Base
{
    private $lightFile = 'plugins/ThemeRevision/Asset/light.css';
    private $darkFile = 'plugins/ThemeRevision/Asset/dark.css';

    public function setColor2Dark(){
        $plugin = Plugin::getInstance($this->container);
        $this->container[colorModel] = $this->container->factory(function ($c) {
            return new DarkColorModel($c);
        });
        $plugin->hook->on('template:layout:css', array('template' => $this->darkFile));
    }

    public function setColor2Light(){
        $plugin = Plugin::getInstance($this->container);
        $this->container[colorModel] = $this->container->factory(function ($c) {
            return new LightColorModel($c);
        });
        $plugin->hook->on('template:layout:css', array('template' => $this->lightFile));
    }

    public function setColorBySys($prefer){
        if ($prefer == "dark"){
            $this->setColor2Dark();
        }
        else {
            $this->setColor2Light();
        }
    }
}

