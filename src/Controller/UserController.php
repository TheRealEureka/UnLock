<?php

namespace App\Controller;

use App\Service\UserService;
use Slim\Views\Twig;

class UserController
{
    private $view;
    private UserService $userService;

    public function __construct(Twig $view, UserService $userService)
    {
        $this->view = $view;
        $this->userService = $userService;
    }
}