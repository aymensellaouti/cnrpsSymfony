<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SessionController
 * @package App\Controller
 * @Route("/session")
 */
class SessionController extends AbstractController
{
    /**
     * @Route("/", name="session")
     */
    public function index(Request $request)
    {
        $session = $request->getSession();
        if (! $session->has('users')) {
            $users = [];
            $session->set('users', $users);
        }
        return $this->render('session/index.html.twig');
    }

    /**
     * @param Request $request
     * @param $name
     * @param $numero
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/add/{name?mohamed}/{numero<\d{8}>}",
     *      name="users.add",
     * )
     */
    public function add(Request $request, $name, $numero) {
        /*
         * Si il y a une session
         * on ajoute le user et on le redirige vers la liste
         * sinon on le redirige vers la liste
         * */
         $session = $request->getSession();
         if ($session->has('users')) {
             $users = $session->get('users');
             $users[$name] = $numero;
             $session->set('users', $users);
         }
         return $this->redirectToRoute('session');
    }

    /**
     * @param Request $request
     * @param $name
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{name}", name="session.delete")
     */
    public function delete(Request $request, $name) {
        /*
         * Si il y a une session
         * on ajoute le user et on le redirige vers la liste
         * sinon on le redirige vers la liste
         * */
        $session = $request->getSession();
        if ($session->has('users')) {
            $users = $session->get('users');
            unset ($users[$name]);
            $session->set('users', $users);
        }
        return $this->redirectToRoute('session');
    }
}
