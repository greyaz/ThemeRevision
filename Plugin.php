<?php
namespace Kanboard\Plugin\ThemeRevision;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ThemeRevision\Helper\ModeSwitchHelper;
use Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper;


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
		// mode switch
		$modeSwitchHelper = new ModeSwitchHelper($this->container);
		if (isset($themeRevisionConfig['mode']) && $themeRevisionConfig['mode'] == "development") {
			$modeSwitchHelper->developmentMode($this);
		}
		else {
			$modeSwitchHelper->productionMode($this);
		}
		// color switch
		$this->helper->register('colorSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper');
		// load JS file
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/revision.js'));
	}

	public function onStartup(){
		// load translations
		Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
		// theme settings
		if (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "light") {
			$this->helper->colorSwitchHelper->setColor2Light();
		}
		elseif (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "dark"){
			$this->helper->colorSwitchHelper->setColor2Dark();
		}
		// Auto Mode
		else {
			// user configure UI
			$this->template->hook->attach('template:user:sidebar:actions', 'ThemeRevision:user/sidebar');
			// get setting
			$scheme = $this->userMetadataModel->get($this->userSession->getId(), "ThemeRevisionColor", "");
			// set color
			if ($scheme == "light"){
				$this->helper->colorSwitchHelper->setColor2Light();
			}
			elseif ($scheme == "dark"){
				$this->helper->colorSwitchHelper->setColor2Dark();
			}
			elseif ($scheme == "auto") {
				// get system prefer
				$sysPrefer = $this->userMetadataModel->get($this->userSession->getId(), "ThemeRevisionSysPrefer", "");
				// set color
				$this->helper->colorSwitchHelper->setColorBySys($sysPrefer);
				// sync system prefer
				$this->route->addRoute('ThemeRevision/Sync:prefer', 'SyncController', 'sync', 'ThemeRevision');
			}
			else{
				$this->helper->colorSwitchHelper->setColor2Light();
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
