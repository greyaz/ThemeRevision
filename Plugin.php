<?php
namespace Kanboard\Plugin\ThemeRevision;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ThemeRevision\Controller\ColorSwitchController;
use Kanboard\Plugin\ThemeRevision\Controller\ModeSwitchController;


class Plugin extends Base
{
	public function initialize()
	{
		global $themeRevisionConfig;

		// load configuration file
		if (file_exists('plugins/ThemeRevision/config.php')) {
			require_once('plugins/ThemeRevision/config.php');
		}
		else {
			require_once('plugins/ThemeRevision/config-default.php');
		}

		// mode settings
		$modeSwitchController = new ModeSwitchController($this->container);
		if (isset($themeRevisionConfig['mode']) && $themeRevisionConfig['mode'] == "development") {
			$modeSwitchController->developmentMode($this);
		}
		else {
			$modeSwitchController->productionMode($this);
		}
		
		// load JS file
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/revision.js'));
	}

	public function onStartup(){
		// load translations
		Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');

		// theme settings
		$themeSwitchController = new ColorSwitchController($this->container);
		if (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "light") {
			$themeSwitchController->setColor2Light($this);
		}
		elseif (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "dark"){
			$themeSwitchController->setColor2Dark($this);
		}
		else {
			// user configure UI
			$this->template->hook->attach('template:user:sidebar:actions', 'ThemeRevision:user/sidebar');

			// set color
			$scheme = $this->userMetadataModel->get($this->userSession->getId(), "ThemeRevisionColor", "");
			
			if ($scheme == "light"){
				$themeSwitchController->setColor2Light($this);
			}
			elseif ($scheme == "dark"){
				$themeSwitchController->setColor2Dark($this);
			}
			elseif ($scheme == "auto") {
				$themeSwitchController->setColorBySys($this);
			}
			else{
				$themeSwitchController->setColor2Light($this);
			}
		}
	}
	
	public function getPluginName()	{ 	 
		return 'ThemeRevision for Kanboard'; 
	}

	public function getPluginAuthor() { 	 
		return 'greyaz'; 
	}

	public function getPluginVersion() { 	 
		return '1.0.0'; 
	}

	public function getPluginDescription() { 
		return "A clean and high-quality theme for Kanboard. It's aimed at better mobile experiences, common plugin compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}
}
