<?php

use Phalcon\Mvc\Controller;
use Phalcon\Translate\Adapter\NativeArray;

class BaseController extends Controller
{
    /**
     * Get the translation array
     * 
     * @return NativeArray
     */
    protected function getTranslation()
    {
        // Ask browser what is the best language
        if ($this->session->has('locale')) {
            $language = $this->session->get('locale');
        } else {
            $language = $this->request->getBestLanguage();
            $this->session->set('locale', substr($language, 0, 2));
        }

        $translationFile = '../app/messages/' . $language . '.php';

        // Check if we have a translation file for that lang
        if (file_exists($translationFile)) {
            require $translationFile;
        } else {
            // Fallback to some default
            require '../app/messages/en.php';
            $language = $this->session->set("locale", "en");
        }

        // Return a translation object $messages comes from the require
        // statement above
        return new NativeArray(
            [
                'content' => $messages,
            ]
        );
    }

}

