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
        return $this->render('base.html.twig');
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

    /**
     * @Route("/heritage", name="heritage")
     */
    public function heritage() {
        return $this->render('formation/heritage.html.twig');
    }
}
