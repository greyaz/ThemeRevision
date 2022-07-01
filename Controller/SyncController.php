<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\BaseController;

class SyncController extends BaseController
{
    public function sync(){
        $user = $this->getUser();
        $prefer = $this->request->getStringParam("prefer");
        $lastPrefer = $this->userMetadataModel->get($user['id'], "ThemeRevisionSysPrefer", "");

        $this->userMetadataModel->save($user['id'], ["ThemeRevisionSysPrefer" => $prefer]);

        if ($prefer != $lastPrefer){
            $this->response->json(array("reload" => true));
        }
        else{
            $this->response->json(array("reload" => false));
        }
    }
}
