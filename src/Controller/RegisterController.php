<?php

namespace App\Controller;

use App\Model\RegisterManager;

class RegisterController extends AbstractController
{
    public function register(): string
    {
        if ($this->user) {
            header('Location: /user');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Clean $_POST
            $data = array_map('trim', $_POST);

            $password1 = $data['password1'];
            $password2 = $data['password2'];

            $this->validatePassword($password1, $password2);

            // Check if form is filled
            if (!isset($data['username']) || empty($data['username'])) {
                $this->errors[] = 'Please fill in username field.';
            }

            if (empty($this->errors)) {
                $username = $data['username'];
                $password = $data['password1'];

                $registerManager = new RegisterManager();
                $registerManager->insert($username, $password);
                $this->successes[] = 'Registration successfull. Please login.';
            }
            return $this->twig->render('Register/register.html.twig', [
                'errors' => $this->errors,
                'successes' => $this->successes
            ]);
        }
        return $this->twig->render('Register/register.html.twig');
    }

    public function validatePassword(string $password1 = null, string $password2 = null): void
    {
        // Compare password1 and password2
        if (!isset($password1) || empty($password1)) {
            $this->errors[] = 'Please fill in password field.';
        }
        if (!isset($password2) || empty($password2)) {
            $this->errors[] = 'Please retype your password field.';
        }
        if ($password1 !== $password2) {
            $this->errors[] = 'Passwords are not the same.';
        }
    }
}
