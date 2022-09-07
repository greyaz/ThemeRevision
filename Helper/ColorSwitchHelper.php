<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;
use Kanboard\Core\Base;
use Kanboard\Plugin\ThemeRevision\Model\CustomColorModel;

class ColorSwitchHelper extends Base
{
    public function setColor2Dark(){
        $this->container['colorModel'] = $this->container->factory(function ($c) {
            return new CustomColorModel($c, "dark");
        });
        $this->saveRealColor("dark");
    }

    public function setColor2Light(){
        $this->container['colorModel'] = $this->container->factory(function ($c) {
            return new CustomColorModel($c, "light");
        });
        $this->saveRealColor("light");
    }

    public function setColorBySys($prefer){
        if ($prefer == "dark"){
            $this->setColor2Dark();
        }
        else {
            $this->setColor2Light();
        }
    }

    public function setUserColor(){
        // get user id
        $userId = $this->userSession->getId();
        // get setting
		$remoteScheme = $this->userMetadataModel->get($userId, "TR.color.scheme.remote", "");
        // set color
        if ($remoteScheme== "light"){
            $this->setColor2Light();
        }
        elseif ($remoteScheme== "dark"){
            $this->setColor2Dark();
        }
        else{
            // set color according to user local prefer
            $this->setColorBySys($this->userMetadataModel->get($userId, "TR.color.scheme.local", ""));
        }
    }

    private function saveRealColor($color){
        //$this->userMetadataModel->save($this->userSession->getId(), ["TR.color.scheme.real" => $color]);
        setcookie("TR.color.scheme.real", $color, 0, "/", "wuec.ucloudadmin.com");
    }
}

