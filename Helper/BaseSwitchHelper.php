<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;
use Kanboard\Core\Base;
use Kanboard\Plugin\ThemeRevision\Plugin;

class BaseSwitchHelper extends Base
{
    protected function getPlugin(){
        return Plugin::getInstance($this->container);
    }
}
