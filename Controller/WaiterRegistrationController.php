<?php

include_once(__DIR__ . '/../Models/WaiterModel.php');
class WaiterRegistrationController extends Controller
{
    protected function process()
    {

        $this->processPOST();

        $this->setPageTitle("Zarejestruj kelnera");
        $this->setSiteTitle("Rejestracja kelnerów");
    }

    private function processPOST()
    {

        if (empty($_POST)) return;

        if($this->dataAvailable())
        {
            $this->AddWaiter();
        }
        else{
            Messager::addNotice("Brak danych");
        }
    }

    private function AddWaiter()
    {
        $model = new WaiterModel();
        $this->setModel($model);

        if($this->isLoginFree($model->getData()['login']))
        {
            $model->insert();
            Redirect::redirect("waiter_registration");
        }
        else
        {
            Messager::addWarning("Login zajęty");
        }
    }

    private function isLoginFree($login)
    {
        $result = WaiterModel::findBy('login', "'$login'");
        if(sizeof($result) > 0){
            return false;
        }
        return true;
    }

    private function setModel(&$model)
    {
        $model->setName($_POST['name']);
        $model->setSurname($_POST['surname']);
        $model->setEmail($_POST['email']);
        $model->setLogin($_POST['login']);
        $model->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
    }

    private function dataAvailable()
    {
        if( !empty($_POST['name']) &&
            !empty($_POST['surname'])&&
            !empty($_POST['email'])&&
            !empty($_POST['login'])&&
            !empty($_POST['password']))
            {
                return true;
            }
        return false;
    }
}
