<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\UserViewController;

class UserSettingsController extends UserViewController
{
    public function show(){
        $user = $this->getUser();
        $this->response->html($this->helper->layout->user('ThemeRevision:user/theme', array(
            'user' => $user,
            'colorScheme' => $this->userMetadataModel->get($user['id'], "TR.color.scheme.user", "")
        )));
    }

    public function save(){
        $user = $this->getUser();
        if ($this->userSession->getId() == $user['id']){
            $this->userMetadataModel->save($user['id'], ["TR.color.scheme.user" => $_POST["color"]]);
            $this->response->redirect($this->helper->url->to('UserSettingsController', 'show', array('plugin' => 'ThemeRevision', 'user_id' => $user['id'])));
        }
    }
}
