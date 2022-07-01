<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\BaseController;

class ThemeSettingsController extends BaseController
{
    public function show(){
        $user = $this->getUser();

        $this->response->html($this->helper->layout->user('ThemeRevision:config/theme-settings', array(
            'user' => $user,
            'color' => $this->userMetadataModel->get($user['id'], "ThemeRevisionColor", "")
        )));
    }

    public function save(){
        $this->userMetadataModel->save($_GET["user_id"], ["ThemeRevisionColor" => $_POST["color"]]);
        $this->response->redirect($this->helper->url->to('ThemeSettingsController', 'show', array('plugin' => 'ThemeRevision')));
    }
}
