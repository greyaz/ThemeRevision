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
		$this->helper->register('modeSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ModeSwitchHelper');
		if (isset($themeRevisionConfig['mode']) && $themeRevisionConfig['mode'] == "development") {
			$this->helper->modeSwitchHelper->developmentMode();
		}
		else {
			$this->helper->modeSwitchHelper->productionMode();
		}

		// color switch
		$this->helper->register('colorSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper');
		if (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "light") {
			$this->helper->colorSwitchHelper->setColor2Light();
		}
		elseif (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "dark"){
			$this->helper->colorSwitchHelper->setColor2Dark();
		}
		else {
			// user config UI
			$this->template->hook->attach('template:user:sidebar:actions', 'ThemeRevision:user/sidebar');
			// sync local system prefer
        	$this->route->addRoute('ThemeRevision/Sync:prefer', 'SyncController', 'sync', 'ThemeRevision');
        	$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/sync.min.js'));
			//$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/dev/js/sync.js'));
		}

		// main js
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/main.min.js'));
	}

	public function onStartup(){
		// load translations
		Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');

		// the value of $themeRevisionConfig['color scheme'] is unset or "auto"
		if(!isset($themeRevisionConfig['color scheme']) || $themeRevisionConfig['color scheme'] != "light" || $themeRevisionConfig['color scheme'] != "dark") {
			// set color
			$this->helper->colorSwitchHelper->setUserColor();
		}
	}

	
	public function getPluginName()	{ 	 
		return 'ThemeRevision for Kanboard'; 
	}

	public function getPluginAuthor() { 	 
		return 'greyaz'; 
	}

	public function getPluginVersion() { 	 
		return '1.0.8'; 
	}

	public function getPluginDescription() { 
		return "A task-first and high quality theme for Kanboard. It's aimed at better mobile experiences, common plugins' compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}
}
