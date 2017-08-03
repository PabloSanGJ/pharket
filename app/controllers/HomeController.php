<?php

class HomeController extends BaseController
{
    /**
     * Home page
     */
    public function indexAction()
    {
        $user_id = $this->request->get("user_id");
        
        if ($user_id != null) {
            $user = Users::findFirst($user_id);
            $this->session->set("investor", $user);
            $this->logger->info('Login: ' . $user->name);
        }
        
        $t = $this->getTranslation();
        
        if ($this->session->has('investor')) {
            $asset = $this->request->get("asset");

            if ($asset != null) {
                $this->session->set("asset", $asset);
            }

            $user = $this->session->get("investor");
            $user_assets = UsersAssets::home($this->session->get("asset"), $t, ['user_id = ' . $user->id]);

            $this->view->user_assets = $user_assets; 
            $this->view->total = array_sum(array_column($user_assets, 'value')); 
            $this->view->assets = Assets::listing($t); 
        }
        
        $this->view->t = $t;
    }
}

