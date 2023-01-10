<?php

function underlinesToCamelCase($string, $capitalizeFirstCharacter = false)
{

    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

    if (!$capitalizeFirstCharacter) {
        $str[0] = strtolower($str[0]);
    }

    return $str;
}

function addErrorClass(array $errors)
{
   if (!empty($errors)) return "error";
}

function listErrors(array $errorsGroup)
{
   if (empty($errorsGroup)) return "";

   $html = "<ul class='errors_list'>";
   foreach ($errorsGroup as $error) $html .= "<li>$error</li>";
   $html .= "</ul>";

   return $html;
}