<?php
namespace Kanboard\Plugin\ThemeRevision;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ThemeRevision\Model\TaskInfoCSSModel;


class Plugin extends Base
{
	public function initialize()
	{
		// register helper
		$this->helper->register('configsDataHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ConfigsDataHelper');
		$this->helper->register('modeSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ModeSwitchHelper');
		$this->helper->register('colorSwitchHelper', '\Kanboard\Plugin\ThemeRevision\Helper\ColorSwitchHelper');

		// add class "TR" to body
		$this->template->setTemplateOverride('layout', 'ThemeRevision:layout');

		// add logo to page
		$this->template->setTemplateOverride('header/title', 'ThemeRevision:header/title');
		$this->template->hook->attach('template:auth:login-form:before', 'ThemeRevision:auth/login_form_before');

		// admin config UI
		$this->route->addRoute('settings/themerevision', 'PluginConfigsController', 'show', 'ThemeRevision');
		$this->template->hook->attach('template:config:sidebar', 'ThemeRevision:settings/sidebar');

		// set CSP
		$this->setContentSecurityPolicy(array('style-src' => '\'self\' \'unsafe-inline\' fonts.googleapis.com'));

		// load configs
		global $themeRevisionConfig;
		$themeRevisionConfig = $this->loadConfigs();

		// init color scheme
		$this->initColorScheme($themeRevisionConfig['color_scheme']);

		// mode switch
		if (isset($themeRevisionConfig['mode']) && $themeRevisionConfig['mode'] == "development") {
			$this->helper->modeSwitchHelper->developmentMode();
		}
		else {
			$this->helper->modeSwitchHelper->productionMode();
		}

		// corner radius
		if (!empty($themeRevisionConfig['corner_radius'])){
			$this->template->hook->attach('template:layout:head', 'ThemeRevision:layout/head_corner_radius', array('radius' => $themeRevisionConfig['corner_radius']));
		}

		// icons replacement
		if (!isset($themeRevisionConfig['enable_google_material_icons']) || $themeRevisionConfig['enable_google_material_icons']) {
			$this->hook->on('template:layout:css', array('template' => 'plugins/ThemeRevision/Asset/material-symbols/index.min.css'));
		}

		// google fonts
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

		// enable custom task display (the css selectors depend on localized text)
		$this->enableCustomTaskDisplay($GLOBALS['themeRevisionConfig']);
	}

	public function getPluginName()	{ 	 
		return 'ThemeRevision for Kanboard'; 
	}

	public function getPluginAuthor() { 	 
		return 'greyaz'; 
	}

	public function getPluginVersion() { 	 
		return '1.1.11'; 
	}

	public function getPluginDescription() { 
		return "A task-first and high quality theme for Kanboard. It's aimed at better mobile experiences, common plugins' compatibilities, and customization friendly."; 
	}
	
	public function getPluginHomepage() { 	 
		return 'https://github.com/greyaz/ThemeRevision'; 
	}

	private function loadConfigs() {
		$configs;
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
            $configs = $mergedConfigs;
            $this->helper->configsDataHelper->saveConfigs($configs);
        }
        //old user, need not update
        elseif (!empty($dbConfigs)){
			// load configs
            $configs = $dbConfigs;
        }
        //new user
        else {
			// load and save configs
            $configs = $defConfigs;
            $this->helper->configsDataHelper->saveConfigs($configs);
        }
		return $configs;
	}

	private function initColorScheme($colorScheme) {
		if (isset($colorScheme) && $colorScheme == "light") {
			$this->helper->colorSwitchHelper->setColor2Light();
		}
		elseif (isset($colorScheme) && $colorScheme == "dark"){
			$this->helper->colorSwitchHelper->setColor2Dark();
		}
		else {
			// user config UI
			$this->route->addRoute('user/:user_id/theme', 'UserSettingsController', 'show', 'ThemeRevision');
			$this->template->hook->attach('template:user:sidebar:actions', 'ThemeRevision:user/sidebar');
			$this->template->hook->attach('template:header:dropdown', 'ThemeRevision:user/header_dropdown');
			$this->helper->colorSwitchHelper->setColorByUser();
		}
	}

	private function enableCustomTaskDisplay($config){
		// adjust column and task info
		$columnList = array();
		$taskList = array();
		foreach($config['column_header_info'] as $key => $value){
			if ($value == false){
				$columnList[] = $key;
			}
		}
		foreach($config['board_task_info'] as $key => $value){
			if ($value == false){
				$taskList[] = $key;
			}
		}
		$this->template->hook->attach('template:layout:head', 'ThemeRevision:layout/head_task_info_display', array(
			'styles' 	=> TaskInfoCSSModel::getFullCSS($columnList, $taskList), 
			'opacity' 	=> $config['task_footer_opacity']
		));
	}
}
