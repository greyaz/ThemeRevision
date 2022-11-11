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

		// regist helper
		$this->helper->register('configsDataHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ConfigsDataHelper');
		$this->helper->register('modeSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ModeSwitchHelper');
		$this->helper->register('colorSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper');

		// load configs
        $defConfigs = $this->helper->configsDataHelper->getDefaultConfigs();
        $dbConfigs = $this->helper->configsDataHelper->loadConfigs();
        $oldConfigs = $this->helper->configsDataHelper->calcOldConfigs($dbConfigs);
        //old user, need update
        if (!empty($oldConfigs)){
			// check color diffs
            $colorDiffs = $this->helper->configsDataHelper->calcColorDiffs($oldConfigs);
            if (!empty($colorDiffs)){
                $this->helper->configsDataHelper->saveColorDiffs($colorDiffs);
            }
			// merged configs
            $mergedConfigs = $this->helper->configsDataHelper->calcMergedConfigs($oldConfigs, $defConfigs);
			// load and save configs
            $themeRevisionConfig = $mergedConfigs;
            $this->helper->configsDataHelper->saveConfigs($themeRevisionConfig);
        }
        //old user, need not update
        elseif (!empty($dbConfigs)){
			// load configs
            $themeRevisionConfig = $dbConfigs;
        }
        //new user
        else {
			// load and save configs
            $themeRevisionConfig = $defConfigs;
            $this->helper->configsDataHelper->saveConfigs($themeRevisionConfig);
        }

		// mode switch
		if (isset($themeRevisionConfig['mode']) && $themeRevisionConfig['mode'] == "development") {
			$this->helper->modeSwitchHelper->developmentMode();
		}
		else {
			$this->helper->modeSwitchHelper->productionMode();
		}

		// color switch
		if (isset($themeRevisionConfig['color_scheme']) && $themeRevisionConfig['color_scheme'] == "light") {
			$this->helper->colorSwitchHelper->setColor2Light();
		}
		elseif (isset($themeRevisionConfig['color_scheme']) && $themeRevisionConfig['color_scheme'] == "dark"){
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
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/settings.min.js'));

		// icons replacement
		if (!isset($themeRevisionConfig['enable_google_material_icons']) || $themeRevisionConfig['enable_google_material_icons']) {
			$this->hook->on('template:layout:css', array('template' => 'plugins/ThemeRevision/Asset/material-symbols/index.min.css'));
		}

		// google fonts replacement
		if (isset($themeRevisionConfig['google_fonts'])){
			$this->template->hook->attach('template:layout:head', 'ThemeRevision:layout/head_google_fonts', array('configs' => $themeRevisionConfig['google_fonts']));
		}

		// syntax highlight
		$this->hook->on('template:layout:css', array('template' => 'plugins/ThemeRevision/Asset/highlight/style.min.css'));
		$this->hook->on('template:layout:js', array('template' => 'plugins/ThemeRevision/Asset/highlight/highlight.min.js'));

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
		return '1.1.6'; 
	}

	public function getPluginDescription() { 
		return "A task-first and high quality theme for Kanboard. It's aimed at better mobile experiences, common plugins' compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}
}
