<?php

include_once __DIR__ . "/../config.php";
include_once __DIR__ . "/../Functions/StringUtils.php";

class Controller
{
   private array $template = [];
   private array $errors = [];
   private array $massErrors = [];

   public function setTitle(string $title)
   {
      $this->template['title'] = $title . " - " . SITE_NAME;
   }

   public function setBodyClass(string $bodyClass)
   {
      $this->template['bodyClass '] = $bodyClass;
   }

   public function addMassError($error)
   {
      $this->massErrors[] = $error;
   }

   public function addError($name, $error)
   {
      $this->errors[$name][] = $error;
   }

   public function getErrors()
   {
      return $this->errors ?? [];
   }

   public function getMassErrors()
   {
      return $this->massErrors ?? [];
   }

   //Bądź validationPassed
   public function noErrorsOccured()
   {
      return empty($this->errors) && empty($this->massErrors);
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
