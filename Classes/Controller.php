<?php
class Controller
{
    private array $template = [];
    private array $errors = [];

    public function setSiteTitle(string $title)
    {
        $this->template['siteTitle'] = $title . " - " . SITE_NAME;
    }

    public function setPageTitle(string $title)
    {
        $this->template['pageTitle'] = $title;
    }

    public function setBodyClass(string $bodyClass)
    {
        $this->template['bodyClass'] = $bodyClass;
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

    public function insertPage()
    {
        extract($this->template);
        include_once __DIR__ . "/../templates/head.php";
        include_once __DIR__ . "/../templates/startOfBody.php";
        include_once __DIR__ . "/../templates/mainNav.php";
        include_once __DIR__ . "/../templates/pageHeader.php";
    }

    public static function insertHtmlEnd()
    {
        self::insertScripts();
    }

    private static function insertScripts()
    {
        include_once __DIR__ . "/../templates/scripts.php";
    }
}
