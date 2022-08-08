<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\BaseController;

class SyncController extends BaseController
{
    public function sync(){
        $user = $this->getUser();
        $newLocalScheme = $this->request->getStringParam("prefer");
        
        $lastLocalScheme = $this->userMetadataModel->get($user['id'], "TR.color.scheme.local", "");
        $remoteScheme= $this->userMetadataModel->get($user['id'], "TR.color.scheme.remote", "");

        $this->userMetadataModel->save($user['id'], ["TR.color.scheme.local" => $newLocalScheme]);

        $this->response->json(array("reload" => ($newLocalScheme != $lastLocalScheme), "remoteScheme" => $remoteScheme));
    }
}
