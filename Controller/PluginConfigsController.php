<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\ConfigController;

class PluginConfigsController extends ConfigController
{
    public function show(){
        $data = $GLOBALS['themeRevisionConfig'];

        $this->response->html($this->helper->layout->config('ThemeRevision:settings/configs', array(
            'title' => t('Settings').' &gt; '.t('ThemeRevision Settings'),
            'configs' => $data,
            'end_keys' => array('light' => $this->getEndKeys($data['light_palette']), 'dark' => $this->getEndKeys($data['dark_palette'])),
            'color_diffs' => $this->helper->configsDataHelper->loadColorDiffs()
        )));
    }

    public function save(){
        if ($this->userSession->isAdmin()){
            $values = $this->request->getValues();
            //checkbox value fix
            $values['overwrite_default_task_color'] = isset($values['overwrite_default_task_color']);
            $values['enable_google_material_icons'] = isset($values['enable_google_material_icons']);

            $this->helper->configsDataHelper->saveConfigs($values);
            $this->response->redirect($this->helper->url->to('PluginConfigsController', 'show', array('plugin' => 'ThemeRevision',)));
        }
    }

    public function dismiss(){
        if ($this->userSession->isAdmin()){
            $this->helper->configsDataHelper->removeColorDiffs();
            $this->response->redirect($this->helper->url->to('PluginConfigsController', 'show', array('plugin' => 'ThemeRevision',)));
        }
    }

    public function reset(){
        if ($this->userSession->isAdmin()){
            $this->helper->configsDataHelper->removeConfigs();
            $this->response->redirect($this->helper->url->to('PluginConfigsController', 'show', array('plugin' => 'ThemeRevision',)));
        }
    }

    private function getEndKeys($palette){
        $keys = array();
        foreach($palette as $key => $value){
            $prefix = explode("-", $key)[0];
            if(isset($lastPrefix) && $lastPrefix != $prefix){
                array_push($keys, $key);
            }
            $lastPrefix = $prefix;
        }
        return $keys;
    }
}