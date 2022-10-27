<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;
use Kanboard\Plugin\ThemeRevision\Helper\BaseHelper;
use Kanboard\Plugin\ThemeRevision\Model\CustomColorModel;

class ColorSwitchHelper extends BaseHelper
{
    public function setColor2Dark(){
        $this->container['colorModel'] = $this->container->factory(function ($c) {
            return new CustomColorModel($c, "dark");
        });
    }

    public function setColor2Light(){
        $this->container['colorModel'] = $this->container->factory(function ($c) {
            return new CustomColorModel($c, "light");
        });
    }

    public function setColorByUser(){
        $this->container['colorModel'] = $this->container->factory(function ($c) {
            return new CustomColorModel($c, "auto");
        });
        
        $this->getPlugin()->on('app.bootstrap', function($c) {
            // get user id
            $userId = $this->userSession->getId();
            // get setting
		    $remoteScheme = $this->userMetadataModel->get($userId, "TR.color.scheme.user", "");
            // set color
            if ($remoteScheme== "light"){
                $this->setColor2Light();
            }
            elseif ($remoteScheme== "dark"){
                $this->setColor2Dark();
            }
        });
    }
}

