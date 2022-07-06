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
        $this->container['colorModel'] = $this->container->factory(function ($c) {
            return new DarkColorModel($c);
        });
        $this->getPlugin()->hook->on('template:layout:css', array('template' => $this->darkFile));
        $this->setColorCookie("dark");
    }

    public function setColor2Light(){
        $this->container['colorModel'] = $this->container->factory(function ($c) {
            return new LightColorModel($c);
        });
        $this->getPlugin()->hook->on('template:layout:css', array('template' => $this->lightFile));
        $this->setColorCookie("light");
    }

    public function setUserColor(){
        // get user id
        $userId = $this->userSession->getId();
        // get setting
		$userScheme= $this->userMetadataModel->get($userId, "ThemeRevisionColor", "");
        // set color
        if ($userScheme == "auto"){
            // set color according to user prefer
            $sysPrefer = $this->userMetadataModel->get($userId, "ThemeRevisionSysPrefer", "");
            $this->setColorBySys($sysPrefer);
        }
        elseif ($userScheme == "dark"){
            $this->setColor2Dark();
        }
        else{
            $this->setColor2Light();
        }
    }

    private function getPlugin(){
        return Plugin::getInstance($this->container);
    }

    private function setColorCookie($color){
        setcookie("CurrentColorScheme", $color);
    }

    private function setColorBySys($prefer){
        if ($prefer == "dark"){
            $this->setColor2Dark();
        }
        else {
            $this->setColor2Light();
        }
    }
}

