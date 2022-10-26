<?php

namespace App\Controller;

use App\Service\UserService;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UserController
{
    private $view;
    private UserService $userService;

    public function __construct(Twig $view, UserService $userService)
    {
        $this->view = $view;
        $this->userService = $userService;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        $args = $request->getParsedBody();
        $error = "";
        if (isset($args["username"]) && isset($args["password"])) {
            $login = $this->userService->login($args["username"], $args["password"]);
            if ($login === false) {
                $error = "Identifiants incorrects";
            } else {
                $_SESSION["user_id"] = $login;
                $_SESSION["username"] = $args["username"];
            }
        }

        return $this->view->render($response, 'index.twig', [
            'conn' => isset($_SESSION['user_id']),
            'name' => $_SESSION["username"] ?? "",
            'error' => $error
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws SyntaxError
     * @throws ORMException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function signup(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        $args = $request->getParsedBody();
        if (isset($args["username"]) && isset($args["password"]) && isset($args["password_confirm"])) {
            $signup = $this->userService->signup($args["username"], $args["password"], $args["password_confirm"]);
            if ($signup === false) {
                if ($args["password"] != $args["password_confirm"]) {
                    $error = "Les mots de passe ne correspondent pas / Ne sont pas assez longs";
                } else {
                    $error = "Le nom d'utilisateur est déjà utilisé";
                }
            } else {
                $_SESSION["user_id"] = $signup;
                $_SESSION["username"] = $args["username"];
                $error = "Inscription réussie";
            }
        } else {
            $error = "Veuillez remplir tous les champs";
        }
        return $this->view->render($response, 'index.twig', [
            'conn' => isset($_SESSION['user_id']),
            'name' => $_SESSION["username"] ?? "",
            'error' => $error
        ]);
    }

    public function logout(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        unset($_SESSION["user_id"]);
        unset($_SESSION["username"]);
        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/');
    }
}
