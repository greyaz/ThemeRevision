<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\ConfigController;
use Kanboard\Plugin\ThemeRevision\Helper\ConfigsConvertHelper;

class PluginConfigsController extends ConfigController
{
    public function show(){
        $dataInDB = $this->configModel->get("ThemeRevision") != "";
        $data = ConfigsConvertHelper::toDBFormat($GLOBALS['themeRevisionConfig']);
        
        $this->response->html($this->helper->layout->config('ThemeRevision:settings/configs', array(
            'title' => t('Settings').' &gt; '.t('ThemeRevision Settings'),
            'configs' => $data,
            'end_keys' => array('light' => $this->getEndKeys($data['light_palette']), 'dark' => $this->getEndKeys($data['dark_palette'])),
            'data_in_db' => $dataInDB
        )));
    }

    public function save(){
        if ($this->userSession->isAdmin()){
            $values = $this->request->getValues();
            //checkbox value fix
            $values['overwrite_default_task_color'] = isset($values['overwrite_default_task_color']);
            $values['enable_google_material_icons'] = isset($values['enable_google_material_icons']);

            $this->configModel->save(array("ThemeRevision" => json_encode($values)));
            $this->response->redirect($this->helper->url->to('PluginConfigsController', 'show', array('plugin' => 'ThemeRevision',)));
        }
    }

    public function reset(){
        if ($this->userSession->isAdmin()){
            $this->configModel->remove("ThemeRevision");
            $this->response->redirect($this->helper->url->to('PluginConfigsController', 'show', array('plugin' => 'ThemeRevision',)));
        }
    }

    public function export(){
        if ($this->userSession->isAdmin()){
            $data = $this->generateConfigsText();
            $this->response->withFileDownload('config.php');
            $this->response->text($data);
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

    private function generateConfigsText(){
        $export = "<?php \n\n";
        foreach($GLOBALS['themeRevisionConfig'] as $key => $value){
            $export .= "\$themeRevisionConfig['" . $key . "'] = ";

            if(is_bool($value)){
                $export .= ($value ? "true" : "false") . ";\n\n";
            }
            elseif (is_array($value)){
                $export .= "array(\n";
                foreach($value as $subKey => $subVal){
                    $export .= "\t'" . $subKey . "' => '" . $subVal . "',\n";
                }
                $export .= ");\n\n";
            }
            else {
                $export .= "'" . $value . "';\n\n";
            }
            
        }
        return $export;
    }
}
