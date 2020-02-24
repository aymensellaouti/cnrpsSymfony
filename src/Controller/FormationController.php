<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function index()
    {
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }
    /**
     * @Route("/bonjours/{name}")
     */
    public function test($name) {
        return $this->render('formation/test.html.twig',[
            'nom' => $name,
            'rh' => 'saloua',
            'veille' => 'sonia'
        ]);
    }
}
