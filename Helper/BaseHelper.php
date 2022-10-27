<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;
use Kanboard\Core\Base;
use Kanboard\Plugin\ThemeRevision\Plugin;

class BaseHelper extends Base
{
    protected function getPlugin(){
        return Plugin::getInstance($this->container);
    }
}
