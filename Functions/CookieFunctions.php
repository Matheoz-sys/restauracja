<?php

function isLoggedIn()
{
    return !empty($_COOKIE['loggedIn']) && $_COOKIE['loggedIn'] == 1;
}
