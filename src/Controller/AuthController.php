<?php

namespace App\Controller;

use App\Model\AuthManager;

class AuthController extends AbstractController
{
    public function log()
    {
        session_start();
        $errorMessages = [];
        $successMessages = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = $_POST["login"];
            $password = $_POST["password"];

            // Check if form is filled
            if (!isset($_POST["login"]) || empty($_POST["login"])) {
                $errorMessages = ["Please fill in login fields."];
            } elseif (!isset($_POST["password"]) || empty($_POST["password"])) {
                $errorMessages = ["Please fill in password field."];
            } else {
                $userManager = new AuthManager();
                $user = $userManager->selectUserByName($login);
                // Check if user exists and password is correct
                if ($user && $user['user_password'] === $password) {
                    $_SESSION["user"] = $login;
                    $_SESSION["user_id"] = $user['user_id'];
                    $successMessages = ["You have been successfully logged in."];
                } else {
                    $errorMessages = ["Invalid username or password."];
                }
            }
        }
        $exeMessages = ['errorMessages' => $errorMessages, 'successMessages' => $successMessages,];
        return $this->twig->render('Log/login.html.twig', $exeMessages);
    }
}
