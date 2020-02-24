<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     */
    public function index(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('user')) {
           $user = $session->get('user');
           $user = 'change Value';
           $session->set('user', $user);
        } else {
            $user = 'new Value';
            $session->set('user', $user);
        }
        return $this->render('session/index.html.twig');
    }
}
