<?php

namespace Kanboard\Plugin\ThemeRevision\Controller;
use Kanboard\Controller\BaseController;

class SyncController extends BaseController
{
    public function sync(){
        $user = $this->userModel->getById($this->request->getIntegerParam('user_id', $this->userSession->getId()));
        if (! $this->userSession->isAdmin() && $this->userSession->getId() != $user['id']) {
            $user = null;
        }
        if (isset($user)){
            $newLocalScheme = $this->request->getStringParam("prefer");
            $lastLocalScheme = $this->userMetadataModel->get($user['id'], "TR.color.scheme.local", "");
            $remoteScheme= $this->userMetadataModel->get($user['id'], "TR.color.scheme.remote", "auto");

            $this->userMetadataModel->save($user['id'], ["TR.color.scheme.local" => $newLocalScheme]);

            $this->response->json(array("reload" => ($newLocalScheme != $lastLocalScheme), "remoteScheme" => $remoteScheme));
        }
        else {
            $this->response->json(array("reload" => false, "remoteScheme" => ""));
        }
    }
}
