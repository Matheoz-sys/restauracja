<?php

include_once __DIR__ . "/../Functions/MainFunctions.php";
include_once __DIR__ . "/../config.php";

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

    public function render()
    {
        $this->insertDocumentBeginning();
        $this->insertBodyStart();
    }

    private function insertDocumentBeginning()
    {
        extract($this->template);
        include_once __DIR__ . "../Templates/head.php";
    }
    
    private function insertBodyStart()
    {
        extract($this->template);
        include_once __DIR__ . "../Templates/startOfBody.php";
    }
}
