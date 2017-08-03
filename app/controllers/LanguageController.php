<?php

class LanguageController extends BaseController
{  
    /**
     * Language change
     */
    public function changeAction()
    {
        $this->session->set("locale", $this->dispatcher->getParam("lang"));
        
        $this->view->t = $this->getTranslation();
        $this->view->pick("index/index");
        $this->view->users = Users::find();
    }
}

