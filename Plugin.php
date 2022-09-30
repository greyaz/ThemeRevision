<?php
namespace Kanboard\Plugin\ThemeRevision;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ThemeRevision\Helper\ConfigsConvertHelper;
use Kanboard\Plugin\ThemeRevision\Helper\ModeSwitchHelper;
use Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper;
use Kanboard\Plugin\ThemeRevision\Helper\GoogleFontsHelper;


class Plugin extends Base
{
	public function initialize()
	{
		global $themeRevisionConfig;
		
		// load configs
		require_once('plugins/ThemeRevision/config-default.php');
		if (file_exists('plugins/ThemeRevision/config.php')){
			require_once('plugins/ThemeRevision/config.php');
		}
		$configsData = $this->configModel->get("ThemeRevision");
		if ($configsData != ""){
			$themeRevisionConfig = array_merge($themeRevisionConfig, ConfigsConvertHelper::toCFFormat(json_decode($configsData, true)));
		}

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
			$this->route->addRoute('user/:user_id/theme', 'UserSettingsController', 'show', 'ThemeRevision');
			$this->template->hook->attach('template:user:sidebar:actions', 'ThemeRevision:user/sidebar');
			$this->template->hook->attach('template:header:dropdown', 'ThemeRevision:user/header_dropdown');
			$this->helper->colorSwitchHelper->setColorByUser();
		}

		// admin config UI
		$this->route->addRoute('settings/themerevision', 'PluginConfigsController', 'show', 'ThemeRevision');
		$this->template->hook->attach('template:config:sidebar', 'ThemeRevision:settings/sidebar');
		$this->hook->on('template:layout:css', array('template' => 'plugins/ThemeRevision/Asset/spectrum/min.css'));
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/spectrum/min.js'));

		// icons replacement
		if (!isset($themeRevisionConfig['enable google material icons']) || $themeRevisionConfig['enable google material icons']) {
			$this->hook->on('template:layout:css', array('template' => 'plugins/ThemeRevision/Asset/material-symbols/index.min.css'));
		}

		// google fonts replacement
		if (isset($themeRevisionConfig['google fonts'])){
			$styles = GoogleFontsHelper::getCssStyles($themeRevisionConfig['google fonts']);
			if (!empty($styles)){
				$this->template->hook->attach('template:layout:head', 'ThemeRevision:layout/head_google_fonts', array('styles' => $styles));
			}
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
		return '1.1.1'; 
	}

	public function getPluginDescription() { 
		return "A task-first and high quality theme for Kanboard. It's aimed at better mobile experiences, common plugins' compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}
}
