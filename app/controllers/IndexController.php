<?php

class IndexController extends BaseController
{
    const DEFAULT_ASSET = "USD";

    /**
     * Landing page
     */
    public function indexAction()
    {
        if (!$this->session->has('investor')) {
            $this->view->users = Users::find();
        }
        
        if (!$this->session->has('asset')) {
            $this->session->set("asset", $this::DEFAULT_ASSET);
        }
        
        $this->view->t = $this->getTranslation();
    }
    
    /**
     * Ends the session
     */
    public function logoutAction()
    {
        $user = $this->session->get("investor");
        $this->logger->info('Logout: ' . $user->name);
        
        $this->session->remove('investor');
        $this->view->pick("index/index");
        $this->view->t = $this->getTranslation();
        $this->view->users = Users::find();
    }
}

