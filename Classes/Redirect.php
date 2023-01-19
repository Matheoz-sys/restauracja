<?php

class Redirect
{
    public static function redirect($location)
    {
        header("Location: $location");
        exit();
    }
}
