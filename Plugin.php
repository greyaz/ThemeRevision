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
		// load configuration file
		global $themeRevisionConfig;
		file_exists('plugins/ThemeRevision/config.php') ? require_once('plugins/ThemeRevision/config.php') : require_once('plugins/ThemeRevision/config-default.php');

		// regist helper
		$this->helper->register('modeSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ModeSwitchHelper');
		$this->helper->register('colorSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper');

		// mode switch
		if (isset($themeRevisionConfig['mode']) && $themeRevisionConfig['mode'] == "development") {
			$this->helper->modeSwitchHelper->developmentMode();
		}
		else {
			$this->helper->modeSwitchHelper->productionMode();
		}

		// color switch
		if (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "light") {
			$this->helper->colorSwitchHelper->setColor2Light();
		}
		elseif (isset($themeRevisionConfig['color scheme']) && $themeRevisionConfig['color scheme'] == "dark"){
			$this->helper->colorSwitchHelper->setColor2Dark();
		}
		else {
			// user config UI
			$this->template->hook->attach('template:user:sidebar:actions', 'ThemeRevision:user/sidebar');
			$this->helper->colorSwitchHelper->setColorByUser();
		}

		// main js
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/main.min.js'));
	}

	public function onStartup(){
		// load translations
		Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
	}

	public function getPluginName()	{ 	 
		return 'ThemeRevision for Kanboard'; 
	}

	public function getPluginAuthor() { 	 
		return 'greyaz'; 
	}

	public function getPluginVersion() { 	 
		return '1.0.9'; 
	}

	public function getPluginDescription() { 
		return "A task-first and high quality theme for Kanboard. It's aimed at better mobile experiences, common plugins' compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}
}
