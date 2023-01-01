<?php

include_once __DIR__ . "/../config.php";
include_once __DIR__ . "/../Functions/StringUtils.php";

class Controller
{
    private array $template = [];

    public function setTitle($title)
    {
        $this->template['title'] = $title . " - " . SITE_NAME;
    }

    public function setBodyClass($bodyClass)
    {
        $this->template['bodyClass '] = $bodyClass;
    }

    public function insertHtmlBeginning()
    {
        $this->insertDocumentBeginning();
        $this->insertBodyBeginning();
        $this->insertNav();
    }
    
    private function insertDocumentBeginning()
    {
        extract($this->template);
        include_once __DIR__ . "/../Templates/head.php";
    }
    
    private function insertBodyBeginning()
    {
        extract($this->template);
        include_once __DIR__ . "/../Templates/startOfBody.php";
    }

    private function insertNav()
    {
        extract($this->template);
        include_once __DIR__ . "/../Templates/mainNav.php";
    }

    public static function insertHtmlEnd()
    {
        self::insertScripts();
    }

    private static function insertScripts()
    {
        include_once __DIR__ . "/../Templates/scripts.php";
    }
}
