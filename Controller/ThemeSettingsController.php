<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\BaseController;

class ThemeSettingsController extends BaseController
{
    public function show(){
        $user = $this->getUser();

        $this->response->html($this->helper->layout->user('ThemeRevision:config/theme-settings', array(
            'user' => $user,
            'colorScheme' => $this->userMetadataModel->get($user['id'], "TR.color.scheme.user", "")
        )));
    }

    public function save(){
        $this->userMetadataModel->save($_GET["user_id"], ["TR.color.scheme.user" => $_POST["color"]]);
        $this->response->redirect($this->helper->url->to('ThemeSettingsController', 'show', array('plugin' => 'ThemeRevision')));
    }
}
