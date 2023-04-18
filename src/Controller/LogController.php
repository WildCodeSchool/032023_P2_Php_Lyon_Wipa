<?php

namespace App\Controller;

class LogController extends AbstractController
{
    public function log()
    {
        define('LOGIN', 'wipa');
        define('PASSWORD', 'admin');
        $errorMessages = [];

        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = $_POST["login"];
            $password = $_POST["password"];

          // Check if form is filled
            if (!isset($_POST["login"]) || empty($_POST["login"])) {
                $errorMessages = ["Please fill in login fields."];
            } elseif (!isset($_POST["password"]) || empty($_POST["password"])) {
                $errorMessages = ["Please fill in password field."];
            } else {
              // Check if informations are corrects
                if ($login == LOGIN && $password == PASSWORD) {
                    $_SESSION["user"] = LOGIN;
                    header("Location: /");
                    die();
                } else {
                    $errorMessages = ["Invalid username or password."];
                }
            }
        }
        return $this->twig->render('Log/login.html.twig', ['errorMessages' => $errorMessages]);
    }
}
