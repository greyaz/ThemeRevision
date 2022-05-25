<?php

namespace Kanboard\Plugin\ThemeRevision;
use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\ThemeRevision\Controller\ModeSwitchController;

class Plugin extends Base
{
	public function initialize()
	{
		global $themeRevisionConfig;

		$modeSwitchController = new ModeSwitchController($this->container);

		if (file_exists('plugins/ThemeRevision/config.php')) {
			require_once('plugins/ThemeRevision/config.php');
		}
		else {
			require_once('plugins/ThemeRevision/config-default.php');
		}
		
		if (isset($themeRevisionConfig['mode']) && $themeRevisionConfig['mode'] == "development") {
			$modeSwitchController->developmentMode($this);
		}
		else {
			$modeSwitchController->productionMode($this);
		}
		
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/revision.js'));
	}
	
	public function getPluginName()	{ 	 
		return 'ThemeRevision for Kanboard'; 
	}

	public function getPluginAuthor() { 	 
		return 'greyaz'; 
	}

	public function getPluginVersion() { 	 
		return '0.8.0 beta'; 
	}

	public function getPluginDescription() { 
		return "A clean and high-quality theme for Kanboard. It's aimed at better mobile experiences, common plugin compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}
}
