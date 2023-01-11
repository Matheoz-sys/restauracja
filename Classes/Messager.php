<?php

include_once __DIR__ . '/../config.php';

class Messager
{
    private static $messages = [];

    public static function readNotifications()
    {
        self::loadSessionMessages();

        if (empty(self::$messages)) return;

        $types = array_keys(self::$messages);

        $html = "";
        foreach ($types as $type) {
            $html .= self::listMessagesInsideULTag(self::$messages, $type);
        }

        Session::getInstance()->clearData(self::class);

        return "<div class='notifications_bar'>" . $html . "</div>";
    }

    private static function listMessagesInsideULTag($messages, $type)
    {
        $list = self::setMessagesHeader($type);
        foreach ($messages[$type] as $message) {
            $list .= "<li>$message</li>";
        }
        return "<ul class='notifications $type'>" . $list . "</ul>";
    }

    private static function setMessagesHeader($type)
    {
        $header = "";
        switch ($type) {
            case ('confirmations'):
                $header .= "Dobre wiadomości:";
                break;
            case ('errors'):
            case ('warnings'):
                $header .= "Wystąpiły następujące błędy:";
                break;
        }
        return !empty($header) ? "<li class='notifications_header'>$header</li>" : "";
    }

    public static function addConfirmation($text)
    {
        self::addMessage('confirmations', $text);
    }

    public static function addNotice($text)
    {
        self::addMessage('notices', $text);
    }

    public static function addError($text)
    {
        self::addMessage('errors', $text);
    }

    public static function addWarning($text)
    {
        self::addMessage('warnings', $text);
    }

    private static function addMessage($type, $text)
    {
        self::loadSessionMessages();

        if (!isset(self::$messages[$type])) {
            self::$messages[$type][] = $text;
        } else if (!in_array($text, self::$messages[$type])) {
            self::$messages[$type][] = $text;
        }

        // dump(self::$messages);

        Session::getInstance()->saveData(self::class, self::$messages);
    }

    private static function loadSessionMessages()
    {
        // session_start();
        if (empty(self::$messages)) self::$messages = Session::getInstance()->loadData(self::class) ?? [];
    }
}
