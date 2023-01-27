<?php

include_once(__DIR__ . '/../Models/WaiterModel.php');

class LoginController extends Controller
{
    protected function process()
    {
        $this->setPageTitle("Logowanie");
        $this->setSiteTitle("Logowanie");

        $this->processPost();

        $admin = WaiterModel::findBy("login", "admin");

        if (empty($admin)) {
            $admin = new WaiterModel();
            $admin->setLogin("admin");
            $admin->setPassword(password_hash("admin", PASSWORD_DEFAULT));
            $admin->setName("Administrator");
            $admin->setSurname("Zoldak & Serafin");
            $admin->setEmail("email@online.de");
            $admin->insert();
        };

        $this->setPageTitle("Witamy w restauracj - " . SITE_NAME);
    }

    private function processPost()
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $this->loginDataCorrect($_POST['login'], $_POST['password']);
        }
    }

    private function loginDataCorrect($login, $password)
    {
        $allWaiters = WaiterModel::findAll();
        foreach ($allWaiters as $waiter) {
            if ($waiter['login'] == $login && password_verify($password, $waiter['password'])) {
                setcookie('loggedIn', true);
                setcookie('loggedInAs', $waiter['name'] . " " . $waiter['surname']);
                Redirect::redirect("/restauracja");
            };
        };
    }
}
