<?php
abstract class Controller
{

    private string $view;
    private array $scripts;
    private array $templateVariables = [];
    private array $errors = [];

    public function __construct($view)
    {
        $this->view = $view;
    }

    protected function setTemplateData($data, $name)
    {
        $this->templateVariables[$name] = $data;
    }

    public function setSiteTitle(string $title)
    {
        $this->templateVariables['siteTitle'] = $title . " - " . SITE_NAME;
    }

    public function setPageTitle(string $title)
    {
        $this->templateVariables['pageTitle'] = $title;
    }

    public function setBodyClass(string $bodyClass)
    {
        $this->templateVariables['bodyClass'] = $bodyClass;
    }

    public function addError($name, $error)
    {
        $this->errors[] = "$name";
        Messager::addError($error);
    }

    public function noErrorsOccured()
    {
        return empty($this->errors);
    }

    public function execute()
    {
        $this->process();
        $this->insertPage();
    }

    private function insertPage()
    {
        extract($this->templateVariables);
        include_once __DIR__ . "/../templates/head.php";
        include_once __DIR__ . "/../templates/startOfBody.php";
        include_once __DIR__ . "/../templates/mainNav.php";
        include_once __DIR__ . "/../templates/pageHeader.php";
        include_once __DIR__ . "/../views/" . $this->view;
        $this->insertScripts();
    }

    public function addScript($scriptName)
    {
        $this->scripts[] = $scriptName;
    }

    private function insertScripts()
    {
        if (empty($this->scripts)) return;
        foreach ($this->scripts as $fileName) {
            include_once __DIR__ . "/../templates/$fileName.php";
        }
    }

    abstract protected function process();
}
