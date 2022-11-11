<?php

namespace Kanboard\Plugin\ThemeRevision\Helper;

use Kanboard\Core\Base;
use Kanboard\Plugin\ThemeRevision\Helper\BaseHelper;
use Kanboard\Plugin\ThemeRevision\Model\DefaultConfigsModel;

class ConfigsDataHelper extends BaseHelper
{
    private $defConfigsModel;

    public function __construct($c) {
        parent::__construct($c);

        $this->defConfigsModel = new DefaultConfigsModel();
    }

    public function loadConfigs(){
        $data = $this->configModel->get("ThemeRevision");
        
        if (!empty($data)){
            return json_decode($data, true);
        }
    }

    public function saveConfigs($configs){
        $this->configModel->save(array("ThemeRevision" => json_encode($configs)));
    }

    public function removeConfigs(){
        $this->configModel->remove("ThemeRevision");
    }

    public function loadColorDiffs(){
        $data = $this->configModel->get("ThemeRevision_ColorDiffs");

        if (!empty($data)){
            return json_decode($data, true);
        }
    }

    public function saveColorDiffs($colorDiffs){
        $this->configModel->save(array(
            "ThemeRevision_ColorDiffs" => json_encode($colorDiffs)
        ));
    }

    public function removeColorDiffs(){
        $this->configModel->remove("ThemeRevision_ColorDiffs");
    }

    public function calcColorDiffs($oldConfigs){
        $lightDiffs = $this->defConfigsModel->checkDiffColor('light_palette', $oldConfigs);
        $darkDiffs = $this->defConfigsModel->checkDiffColor('dark_palette', $oldConfigs);

        $saveList = array();
        
        if (!empty($lightDiffs)){
            $saveList['light_palette'] = $lightDiffs;
        }
        if (!empty($darkDiffs)){
            $saveList['dark_palette'] = $darkDiffs;
        }

        return $saveList;
    }

    public function calcOldConfigs($dbConfigs){
        $oldConfigs = array();
        // has data
        if (!empty($dbConfigs)){
            // old data
            if (empty($dbConfigs['version']) || $dbConfigs['version'] !=  $this->defConfigsModel->getVersion()){
                return $dbConfigs;
            }
            // new data
            return $oldConfigs;
        }  
        // no data in db and no config file
        if (empty($dbConfigs) && !file_exists('plugins/ThemeRevision/config.php')){
            return $oldConfigs;
        }
        // no data and has config file
        if (empty($dbConfigs) && file_exists('plugins/ThemeRevision/config.php')){
            $themeRevisionConfig;
            // load data
            if (file_exists('plugins/ThemeRevision/config-default.php')){
                require_once('plugins/ThemeRevision/config-default.php');
            }
            if (file_exists('plugins/ThemeRevision/config.php')){
                require_once('plugins/ThemeRevision/config.php');
            }
            if (!empty($themeRevisionConfig)){
                $themeRevisionConfig = $this->toV2Format($themeRevisionConfig);
            }
            return $themeRevisionConfig;
        }
        // other
        return $oldConfigs;
    }

    public function calcMergedConfigs($oldConfigs, $defConfigs){
        $mergedConfigs = $defConfigs;
        
        if (is_array($oldConfigs)){
            $mergedConfigs = array_merge($defConfigs, array_diff_key($oldConfigs, ["light_palette" => "", "dark_palette" => ""]));
        }

        return $mergedConfigs;
    }

    public function getDefaultConfigs(){
        return $this->defConfigsModel->getDefaultConfigs();
    }

    public function getVersion(){
        return $this->defConfigsModel->getVersion();
    }

    private function toV2Format(array $config){
        $return = (object)[];
        foreach($config as $key => $value){
            $return->{strtr($key, " ", "_")} = $value;
        }
        return (array) $return;
    }

    public function getCandidates($configName){
        return $this->defConfigsModel->getCandidates($configName);
    }

    public function getCandidatesInTemplate($configName){
        $list = array();
        foreach($this->helper->configsDataHelper->getCandidates($configName) as $candidate){
            $list[$candidate] = t(ucwords($candidate));
        }
        return $list;
    }

    private function toV1Format(array $config){
        $return = (object)[];
        foreach($config as $key => $value){
            $return->{strtr($key, "_", " ")} = $value;
        }
        return (array) $return;
    }
}
