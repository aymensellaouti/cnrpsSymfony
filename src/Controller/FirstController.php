<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("/first", name="first")
     */
    public function index()
    {
        return $this->render('first/index.html.twig');
    }

    /**
     * @Route("/second", name="second")
     */
    public function second(Request $request) {
        return $this->render('first/second.html.twig');
    }

    /**
     * @Route("/bonjour/{name}")
     */
    public function sayBonjour($name) {
        return $this->render('first/sayHallo.html.twig', [
            'monNom' => $name
        ]);
    }
}
