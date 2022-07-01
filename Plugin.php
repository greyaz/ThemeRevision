<?php
namespace Kanboard\Plugin\ThemeRevision;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ThemeRevision\Helper\ModeSwitchHelper;
use Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper;


class Plugin extends Base
{
	private $adminScheme;

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
		// theme settings
		$this->adminScheme = $themeRevisionConfig['color scheme'];
		// light and dark mode
		if (isset($this->adminScheme) && $this->adminScheme == "light") {
			$this->helper->colorSwitchHelper->setColor2Light();
		}
		elseif (isset($this->adminScheme) && $this->adminScheme == "dark"){
			$this->helper->colorSwitchHelper->setColor2Dark();
		}
		else {
			// user configure UI
			$this->template->hook->attach('template:user:sidebar:actions', 'ThemeRevision:user/sidebar');
			// sync system prefer
        	$this->route->addRoute('ThemeRevision/Sync:prefer', 'SyncController', 'sync', 'ThemeRevision');
        	$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/sync-color.js'));
		}
		// load JS file
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/revision.js'));
	}

	public function onStartup(){
		// load translations
		Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');

		// user Mode
		if(!isset($this->adminScheme) || $this->adminScheme != "light" || $this->adminScheme != "dark") {
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
		return '1.0.2'; 
	}

	public function getPluginDescription() { 
		return "A clean and high-quality theme for Kanboard. It's aimed at better mobile experiences, common plugin compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}
}
