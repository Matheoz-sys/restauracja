<?php

class Controller
{
    protected array $template = [];
    protected string $templateName = "";

    public function __construct($templateName)
    {
        include_once("../config.php");
        $this->templateName = $templateName;
    }

    public function setProperty($propName, $val)
    {
        $this->template[$propName] = $val;
    }

    public function setTitle($title)
    {
        $this->template['title'] = $title;
    }

    public function setBodyClass($bodyClass)
    {
        $this->template['bodyClass'] = $bodyClass;
    }

    public function render()
    {
        $templateData = $this->template;
        // dump($templateData);
        extract($templateData);

        $this->insertDocumentBeginning();
        $this->insertBodyStart();
        $this->insertBodyAndHtmlEndTags();
    }

    private function insertDocumentBeginning()
    {
        $bodyClass = $this->template['bodyClass'] ?? "";
        $title = !empty($this->template['title']) ? $this->template['title'] . " - " . SITE_NAME : SITE_NAME;
        include_once '../Templates/head.php';
    }

    private function insertBodyStart()
    {
        include_once "../Templates/startOfBody.php";
    }

    private function insertBodyAndHtmlEndTags()
    {
        include_once "../Templates/endOfHtml.php";
    }
}
