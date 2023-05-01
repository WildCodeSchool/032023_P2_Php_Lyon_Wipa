<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use App\Model\UserManager;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;
    protected array|false $user;
    public array $errors;
    public array $successes;


    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        // start session and use it as global nammed 'user' in twig
        $userManager = new UserManager();
        $this->user = isset($_SESSION['id']) ? $userManager->selectOneById($_SESSION['id']) : false;
        $this->twig->addGlobal('user', $this->user);
        $this->errors = [];
        $this->successes = [];
    }
}
